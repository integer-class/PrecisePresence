<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalAbsensi;
use App\Models\JenisAbsensi;
use App\Models\Perizinan;
use Illuminate\Support\Facades\DB;





use Illuminate\Http\Request;

class history extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = DB::table('absensi')
        ->join('jadwal_absensi', 'absensi.id_jadwal_absensi', '=', 'jadwal_absensi.id_jadwal_absensi')
        ->join('jenis_absensi', 'jadwal_absensi.id_jenis_absensi', '=', 'jenis_absensi.id_jenis_absensi')
        ->where('absensi.id_karyawan', auth()->user()->karyawan->id_karyawan)
        ->select(
            'absensi.*',
            'jenis_absensi.nama_jenis_absensi'
        )
        ->get();

    if ($absensi->isEmpty()) {
        return response()->json([
            'message' => 'No data found or only one entry',
            'data' => $absensi
        ]);
    }

    return response()->json([
        'message' => 'Success',
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

    // Cek apakah ada izin aktif
    $activePermits = Perizinan::where('id_karyawan', $karyawan->id_karyawan)
        ->where('status', 'approved')
        ->where('is_active', true)
        ->where(function ($query) {
            $query->whereDate('tanggal_mulai', '<=', Carbon::now())
                  ->whereDate('tanggal_selesai', '>=', Carbon::now());
        })
        ->exists();

    // Handle izin aktif dan force_checkin
    if ($activePermits) {
        if ($request->input('force_checkin')) {
            // Update perizinan menjadi tidak aktif
            Perizinan::where('id_karyawan', $karyawan->id_karyawan)
                ->where('status', 'approved')
                ->where('is_active', true)
                ->update(['is_active' => false]);
        } else {
            // Jika force_checkin tidak diaktifkan, minta konfirmasi
            return response()->json([
                'message' => 'Anda memiliki izin aktif. Apakah Anda ingin menghentikan perizinan dan melanjutkan check-in?',
                'require_confirmation' => true,
            ], 200);
        }
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

    // Kembalikan respons berdasarkan jadwal
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
