<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalAbsensi;
use App\Models\JenisAbsensi;



use Illuminate\Http\Request;

class history extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::where('id_karyawan', auth()->user()->karyawan->id_karyawan)->get();

        if (!$absensi) {
            return response()->json([
                'message' => 'no data found or only one entry',
                'data' => $absensi
            ]);
        }
        return response()->json([
            'message' => 'succes',
            'data' => $absensi
        ]);

    }
    public function cek(Request $request)
    {
        // Pastikan pengguna memiliki karyawan terkait
        $karyawan = auth()->user()->karyawan;

        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan tidak ditemukan untuk pengguna ini.',
                'data' => null,
            ], 404);
        }

        // Cari jadwal berikutnya
        $jadwalBerikutnya = JadwalAbsensi::where('id_divisi', $karyawan->id_divisi)
            ->whereNotIn('id_jadwal_absensi', function ($query) use ($karyawan) {
                $query->select('id_jadwal_absensi')
                    ->from('absensi')
                    ->where('id_karyawan', $karyawan->id_karyawan)
                    ->whereDate('waktu_absensi', now()->toDateString());
            })
            ->orderBy('waktu', 'asc')
            ->first();

        // Kembalikan respons
        if ($jadwalBerikutnya) {
            return response()->json([
                'message' => 'success',
                'data' => $jadwalBerikutnya,
            ]);
        }

        return response()->json([
            'message' => 'no data found',
            'data' => null,
        ]);
    }



public function cek_perhari(Request $request)
{
     // Validasi input
     $validated = $request->validate([
        'date' => 'required|date',
    ]);



    // Ubah tanggal menjadi instance Carbon
    $carbonDate = Carbon::parse($validated['date']);

    $absensi = Absensi::where('id_karyawan',auth()->user()->karyawan->id_karyawan)
            ->whereDate('waktu_absensi', $carbonDate)
            ->get();

    return response()->json([
        'message' => 'success',
        'data' => $absensi
    ]);


}

public function cek_jadwal()
{
    $jadwal = JadwalAbsensi::where('id_divisi', auth()->user()->karyawan->id_divisi)
        ->with(['jenisAbsensi', 'absensi']) // Memuat relasi jenisAbsensi dan absensi
        ->orderBy('waktu', 'asc')
        ->get();

    return response()->json([
        'message' => 'success',
        'data' => $jadwal,
    ]);
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
        //
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
