<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class HRD_AbsensiController extends Controller
{
    public function index()
    {

        $absensi = Absensi::whereDate('check_in_time', Carbon::today())
        ->join('karyawan', 'absensi.id_karyawan', '=', 'karyawan.id_karyawan')
        ->get();

        $type_menu = 'absensi';

        return view('hrd.absensi.index', compact('type_menu', 'absensi'));
    }

    public function checkIn(Request $request)
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

        if ($absensi) {
            return response()->json(['message' => 'Already checked in today.'], 400);
        }

        $response = Http::attach(
            'file', file_get_contents($file), $file->getClientOriginalName()
        )->post('http://127.0.0.1:8000/face_match/', [
            'threshold' => 0.7,
        ]);

        $data = $response->json();

        // return response()->json(['message' => 'Absensi berhasil!', 'id_karyawan' => $data['id_karyawan'], 'user_id' => $user_id]);



        if ($response->ok() && $data['status']=='success' && $data['id_karyawan'] == $user_id) {



            $imageName = $file->getClientOriginalName();
            $thumbnailPath = $file->move(public_path('checkin_photos'), $imageName);

            // Buat entri absensi baru
            Absensi::create([
                'id_karyawan' => $user_id,
                'lon' => $validated['lon'],
                'lat' => $validated['lat'],
                'foto_checkin' => $imageName,
                'check_in_time' => Carbon::now(),
                'status' => 'checkin'
            ]);

            // Kirim data ke FastAPI
            // $this->sendToFastAPI($user_id, $file);

            // Respons berhasil
            return response()->json(['message' => 'Absensi berhasil!', 'distance' => $imageName]);
        } else {
            // Data wajah tidak cocok
            return response()->json(['message' => 'Wajah tidak cocok.'], 400);
        }
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

        $response = Http::attach(
            'file', file_get_contents($file), $file->getClientOriginalName()
        )->post('http://127.0.0.1:8000/face_match/', [
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
        )->post("http://127.0.0.1:8000/register_face_personal/?user_id={$user_id}");
    }
}
