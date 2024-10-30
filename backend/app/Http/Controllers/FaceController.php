<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FaceController extends Controller
{
    public function showUploadForm()
    {
        return view('upload'); // Ganti dengan nama view Anda
    }

    public function uploadFiles(Request $request)
    {
        // Validasi input
        $request->validate([
            'files.*' => 'image|mimes:jpeg,png,jpg|max:5048', // Max size 5MB
        ]);

        $files = $request->file('files');
        $userId = $request->user_id;

        // Buat instance Guzzle client
        $client = new Client();

        // Buat array untuk file upload
        $multipart = [];

        // Menambahkan user_id ke query
        $query = ['user_id' => $userId];

        // Menambahkan file ke multipart
        foreach ($files as $file) {
            $multipart[] = [
                'name' => 'files',
                'contents' => fopen($file->getRealPath(), 'r'),
                'filename' => $file->getClientOriginalName(),
            ];
        }

        try {
            // Kirim permintaan POST ke FastAPI
            // $response = $client->post('http://20.211.74.84/register_face/', [
              $response = $client->post('http://127.0.0.1:8000/register_face/', [
                'query' => $query,
                'multipart' => $multipart,
            ]);

            return response()->json(json_decode($response->getBody()->getContents()));
        } catch (GuzzleException $e) {
            return response()->json(['error' => 'Guzzle error: ' . $e->getMessage()], 500);
        }
    }
}
