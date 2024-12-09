<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalAbsensi;
use App\Models\JenisAbsensi;
use App\Models\Perizinan;




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






        $activePermits = Perizinan::where('id_karyawan', auth()->user()->karyawan->id_karyawan)
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
            Perizinan::where('id_karyawan', auth()->user()->karyawan->id_karyawan)
                ->where('status', 'approved')
                ->where('is_active', 1)
                ->where(function ($query) {
                    $query->whereDate('tanggal_mulai', '<=', Carbon::now())
                          ->whereDate('tanggal_selesai', '>=', Carbon::now());
                })
                ->update(['is_active' => 0]);
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


    $jadwal = JadwalAbsensi::where('id_divisi', auth()->user()->karyawan->id_divisi)
    ->with(['jenisAbsensi']) // Memuat relasi jenisAbsensi dan absensi
    ->orderBy('waktu', 'asc')
    ->get();


    $carbonDate = Carbon::parse($validated['date']);

    $absensi = Absensi::where('id_karyawan',auth()->user()->karyawan->id_karyawan)
            ->join ('jadwal_absensi','absensi.id_jadwal_absensi','=','jadwal_absensi.id_jadwal_absensi')
            ->whereDate('waktu_absensi', $carbonDate)
            ->get();

    return response()->json([
        'message' => 'success',
        'data' => $absensi,
        'jumlah_jadwal' => $jadwal,
    ]);


}

public function cek_jadwal()
{
    $jadwal = JadwalAbsensi::where('id_divisi', auth()->user()->karyawan->id_divisi)
        ->with(['jenisAbsensi']) // Memuat relasi jenisAbsensi dan absensi
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
