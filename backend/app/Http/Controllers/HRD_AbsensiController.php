<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HRD_AbsensiController extends Controller
{
    public function validateFace(Request $request)
    {
        // Validasi input
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'user_id' => 'required|integer',
        ]);

        // Ambil user_id dari request
        $user_id = $request->input('user_id');

        // Ambil file gambar
        $file = $request->file('file');

        try {
            $response = Http::attach(
                'file', file_get_contents($file), $file->getClientOriginalName()
            )->post('http://127.0.0.1:8000/face_match/', [
                'threshold' => 0.7,
            ]);

            // Dapatkan data respons
            $data = $response->json();

            // Cek hasil respons
            if ($response->ok() && $data['status'] === 'success') {
                // Jika cocok, simpan absensi ke database
                $absensi = Absensi::create([
                    'id_karyawan' => $data['id_karyawan'],
                    'waktu' => now(),
                ]);

                // Kirim data ke FastAPI
                $this->sendToFastAPI($data['id_karyawan'], $file);

                return response()->json(['message' => 'Absensi berhasil!', 'distance' => $data['distance']]);
            } else {
                // Jika tidak cocok
                return response()->json(['message' => $data['message']], 400);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghubungi FastAPI'], 500);
        }
    }

    protected function sendToFastAPI($user_id, $file)
    {
        try {

            $response = Http::attach(
                'file', file_get_contents($file), $file->getClientOriginalName()
            )->post("http://127.0.0.1:8000/register_face_personal/?user_id={$user_id}");


            if ($response->failed()) {
                \Log::error('Gagal mengirim data ke FastAPI: ' . $response->body());
            }
        } catch (\Exception $e) {

            \Log::error('Gagal mengirim data ke FastAPI: ' . $e->getMessage());
        }
    }
}
