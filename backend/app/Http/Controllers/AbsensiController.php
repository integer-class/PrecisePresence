<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\JadwalAbsensi;
use App\Models\Cabang;
use App\Models\JenisAbsensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Validasi input
            $validated = $request->validate([
                'id_karyawan' => 'required|string',
                'foto' => 'required|image|max:2048',
                'lon' => 'required|string',
                'lat' => 'required|string',
            ]);

            // Cari karyawan berdasarkan ID
            $karyawan = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            if (!$karyawan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Karyawan tidak ditemukan.',
                ], 404);
            }

            // Periksa jarak antara karyawan dan cabang
            $cabang = Cabang::where('id_cabang', $karyawan->id_cabang)->first();
            $distance = $this->calculateDistance($cabang->latitude, $cabang->longitude, $validated['lat'], $validated['lon']);
            if ($distance > $cabang->radius) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda berada di luar radius yang diizinkan untuk absensi.',
                ], 400);
            }

            // Periksa jadwal absensi berikutnya
            $jadwalBerikutnya = JadwalAbsensi::where('id_divisi', $karyawan->id_divisi)
                ->whereNotIn('id_jadwal_absensi', function ($query) use ($request) {
                    $query->select('id_jadwal_absensi')
                        ->from('absensi')
                        ->where('id_karyawan', $request->id_karyawan)
                        ->whereDate('waktu_absensi', now()->toDateString());
                })
                ->orderBy('waktu', 'asc')
                ->first();

            if (!$jadwalBerikutnya) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Semua jadwal absensi telah terpenuhi atau sudah absen di jadwal yang ditentukan.',
                ], 400);
            }

            // Ambil aturan waktu dari jenis absensi
            $jenisAbsensi = JenisAbsensi::find($jadwalBerikutnya->id_jenis_absensi);
            if (!$jenisAbsensi) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jenis absensi tidak valid.',
                ], 400);
            }

            // Verifikasi wajah dengan API
            $file = $request->file('foto');
            $response = Http::attach(
                'file', file_get_contents($file), $file->getClientOriginalName()
            )->post('http://20.11.20.43/face_match/', [
                'threshold' => 0.7,
            ]);

            $data = $response->json();

            if ($response->ok() && $data['status'] == 'success' && $data['id_karyawan'] == $request->id_karyawan) {
                // Simpan foto ke storage
                $fotoPath = $file->store('absensi', 'public');

                // Tentukan status keterlambatan berdasarkan aturan waktu
                $jadwalWaktu = Carbon::parse($jadwalBerikutnya->waktu);
                $waktuAbsen = now();
                $catatan = 'tidak valid'; // Default jika aturan tidak sesuai

                if ($jenisAbsensi->aturan_waktu == '=') {
                    $catatan = $waktuAbsen->eq($jadwalWaktu) ? 'tepat waktu' : 'tidak tepat waktu';
                } elseif ($jenisAbsensi->aturan_waktu == '<') {
                    $catatan = $waktuAbsen->lt($jadwalWaktu) ? 'lebih awal baik' : 'terlambat';
                } elseif ($jenisAbsensi->aturan_waktu == '>') {
                    $catatan = $waktuAbsen->gt($jadwalWaktu) ? 'lebih akhir baik' : 'terlalu awal';
                } elseif ($jenisAbsensi->aturan_waktu == '>=') {
                    $catatan = $waktuAbsen->gte($jadwalWaktu) ? 'tepat waktu atau lebih akhir' : 'terlalu awal';
                } elseif ($jenisAbsensi->aturan_waktu == '<=') {
                    $catatan = $waktuAbsen->lte($jadwalWaktu) ? 'tepat waktu atau lebih awal' : 'terlambat';
                }

                $waktuAbsen = now(); // Otomatis mengambil zona waktu server
                $jadwalWaktu = Carbon::parse($jadwalBerikutnya->waktu)->setTimezone('Asia/Jakarta');

                // Selisih dalam menit (bisa negatif jika lebih awal)
                $selisihMenit = $waktuAbsen->diffInMinutes($jadwalWaktu, false);

                // Logika status absensi
                if ($selisihMenit > 0) {
                    // Absensi terlambat
                    $selisihJam = intdiv($selisihMenit, 60);
                    $selisihSisaMenit = $selisihMenit % 60;
                    $statusAbsensi = "lebih awal {$selisihJam} jam {$selisihSisaMenit} menit";
                } elseif ($selisihMenit < 0) {
                    // Absensi lebih awal
                    $selisihMenit = abs($selisihMenit);
                    $selisihJam = intdiv($selisihMenit, 60);
                    $selisihSisaMenit = $selisihMenit % 60;
                    $statusAbsensi = "terlambat {$selisihJam} jam {$selisihSisaMenit} menit";
                } else {
                    // Tepat waktu
                    $statusAbsensi = "tepat waktu";
                }



                // Simpan data absensi
                $absensi = Absensi::create([
                    'id_karyawan' => $request->id_karyawan,
                    'id_jadwal_absensi' => $jadwalBerikutnya->id_jadwal_absensi,
                    'lon' => $request->lon,
                    'lat' => $request->lat,
                    'foto' => $fotoPath,
                    'catatan' => $catatan,
                    'waktu_absensi' => $waktuAbsen,
                    'status_absensi' => $statusAbsensi,
                ]);

                // Perbarui status jadwal absensi
                $jadwalBerikutnya->update(['status' => 'hadir']);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Absensi berhasil dilakukan.',
                    'data' => $absensi,
                    'jadwal_absensi' => $jadwalBerikutnya,
                ]);
            }

            // Jika verifikasi wajah gagal
            return response()->json(['message' => 'Wajah tidak cocok.'], 400);

    }


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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
