<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use App\Models\Setting;
use App\Models\Perizinan;

class HRD_AbsensiController extends Controller
{
    public function index()
    {

        // $absensi = Absensi::whereDate('check_in_time', Carbon::today())
        // ->join('karyawan', 'absensi.id_karyawan', '=', 'karyawan.id_karyawan');


        $absensi = Absensi::whereDate('waktu_absensi', Carbon::today())
        ->join('karyawan', 'absensi.id_karyawan', '=', 'karyawan.id_karyawan')
        ->select('absensi.*', 'karyawan.nama')
        ->get();

        $type_menu = 'absensi';

        return view('hrd.absensi.index', compact('type_menu', 'absensi'));
    }

    public function show($id)
    {
        $type_menu = 'absensi';
        $absensi = Absensi::where('id', $id)
        ->whereDate('check_in_time', Carbon::today())
        ->first();
        $karyawan = Karyawan::where('id_karyawan', $absensi->id_karyawan)->first();


        return view('hrd.absensi.show', compact('absensi', 'type_menu', 'karyawan'));



    }

    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'id_karyawan' => 'required|integer',
            'lon' => 'required|numeric',
            'lat' => 'required|numeric',
            'foto' => 'required|file|mimes:jpg,png,jpeg',
        ]);

        $user_id = $validated['id_karyawan'];
        $file = $request->file('foto');
        $today = Carbon::today();

        $activePermits = Perizinan::where('id_karyawan', $user_id)
        ->where('status', 'approved')
        ->where('is_active', true)
        ->where(function ($query) {
            $query->whereDate('tanggal_mulai', '<=', Carbon::now())
                  ->whereDate('tanggal_selesai', '>=', Carbon::now());
        })
        ->exists();

        if ($activePermits && !$request->input('force_checkin')) {
            return response()->json(['message' => 'Anda memiliki izin aktif. Apakah Anda ingin menghentikan perizinan dan melanjutkan check-in?', 'require_confirmation' => true], 400);
        }


          // Jika force_checkin diaktifkan, update status perizinan menjadi "cancelled"
          if ($activePermits && $request->input('force_checkin')) {
            Perizinan::where('id_karyawan', $user_id)
                ->where('status', 'approved')
                ->where('is_active', 1)
                ->where(function ($query) {
                    $query->whereDate('tanggal_mulai', '<=', Carbon::now())
                          ->whereDate('tanggal_selesai', '>=', Carbon::now());
                })
                ->update(['is_active' => 0]);
        }

        // Cek apakah karyawan sudah melakukan check-in hari ini
        $absensi = Absensi::where('id_karyawan', $user_id)
                          ->whereDate('check_in_time', $today)
                          ->first();





        if ($absensi) {
            return response()->json(['message' => 'Already checked in today.'], 400);
        }

        // Ambil data pengaturan (lokasi dan radius) dari tabel settings
        $setting = Setting::first();

        if (!$setting) {
            return response()->json(['message' => 'Pengaturan lokasi belum dikonfigurasi.'], 500);
        }

        // Hitung jarak antara lokasi karyawan dan lokasi kantor
        $distance = $this->calculateDistance($setting->latitude, $setting->longitude, $validated['lat'], $validated['lon']);

        if ($distance > $setting->radius) {
            return response()->json(['message' => 'Anda berada di luar radius yang diizinkan untuk absensi.'], 400);
        }

        // Panggil API untuk verifikasi wajah
        $response = Http::attach(
            'file', file_get_contents($file), $file->getClientOriginalName()
        )->post('http://20.11.20.43/face_match/', [
            'threshold' => 0.7,
        ]);

        $data = $response->json();

        if ($response->ok() && $data['status'] == 'success' && $data['id_karyawan'] == $user_id) {
            $imageName = $file->getClientOriginalName();
            $thumbnailPath = $file->move(public_path('checkin_photos'), $imageName);

            $current_time = Carbon::now();
            $status = $current_time->lte(Carbon::parse($setting->jam_masuk)) ? 'Tepat Waktu' : 'Terlambat';

            // Buat entri absensi baru
            Absensi::create([
                'id_karyawan' => $user_id,
                'lon' => $validated['lon'],
                'lat' => $validated['lat'],
                'foto_checkin' => $imageName,
                'check_in_time' => Carbon::now(),
                'keterangan' => $status
            ]);

            return response()->json(['message' => 'Absensi berhasil!', 'distance' => $distance]);
        } else {
            return response()->json(['message' => 'Wajah tidak cocok.'], 400);
        }
    }

    /**
     * Menghitung jarak antara dua titik koordinat menggunakan Haversine formula
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float Jarak dalam meter
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        return $distance;
    }




    public function checkOut(Request $request)
    {

        $validated = $request->validate([
            'id_karyawan' => 'required|integer',
            'lon' => 'required|string',
            'lat' => 'required|string',
            'foto' => 'required|file|mimes:jpg,png,jpeg',
        ]);


        $user_id = $validated['id_karyawan'];
        $file = $request->file('foto');
        $today = Carbon::today();


        $absensi = Absensi::where('id_karyawan', $user_id)
                          ->whereDate('check_in_time', $today)
                          ->first();

        if (!$absensi) {
            return response()->json(['message' => 'No check-in record found for today.'], 400);
        }

        $setting = Setting::first();

        if (!$setting) {
            return response()->json(['message' => 'Pengaturan lokasi belum dikonfigurasi.'], 500);
        }

        // Hitung jarak antara lokasi karyawan dan lokasi kantor
        $distance = $this->calculateDistance($setting->latitude, $setting->longitude, $validated['lat'], $validated['lon']);

        if ($distance > $setting->radius) {
            return response()->json(['message' => 'Anda berada di luar radius yang diizinkan untuk absensi.'], 400);
        }





        $response = Http::attach(
            'file', file_get_contents($file), $file->getClientOriginalName()
        )->post('http://20.11.20.43/face_match/', [
            'threshold' => 0.7,
        ]);

        $data = $response->json();

        // return response()->json(['message' => 'Absensi berhasil!', 'id_karyawan' => $data['id_karyawan'], 'user_id' => $user_id]);


        if ($response->ok() && $data['status']=='success' && $data['id_karyawan'] == $user_id) {

            $imageName = $file->getClientOriginalName();
            $thumbnailPath = $file->move(public_path('checkin_photos'), $imageName);





            // Buat entri absensi baru
            $absensi->update([
                'foto_checkout' => $imageName,
                'check_out_time' => Carbon::now(),
                'status' => 'checkout'
            ]);


            return response()->json(['message' => 'Absensi pulang berhasil!', 'distance' => $data['distance']]);
        } else {
            // Data wajah tidak cocok
            return response()->json(['message' => 'Wajah tidak cocok.'], 400);
        }
    }



    protected function sendToFastAPI($user_id, $file)
    {
        $response = Http::attach(
            'file', file_get_contents($file), $file->getClientOriginalName()
        )->post("http://20.11.20.43/register_face_personal/?user_id={$user_id}");
    }
}
