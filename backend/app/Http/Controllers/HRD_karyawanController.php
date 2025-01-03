<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\DB;
// Model
use App\Models\Karyawan;

class HRD_karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search') ?? null;
        $type_menu = 'karyawan';

        if ($search) $karyawan = karyawan::where('nama', 'LIKE', "%$search%")->get();
        else $karyawan = karyawan::all();

        return view('hrd.karyawan.index', compact('karyawan', 'type_menu'));
    }


    public function detail($id)
    {
        $type_menu = 'karyawan';
        $karyawan = karyawan::join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
            ->where('karyawan.id_karyawan', $id)
            ->select('karyawan.*', 'divisi.nama_divisi')
            ->first();

        $aktivitas = DB::table('karyawan')
            ->join('absensi', 'karyawan.id_karyawan', '=', 'absensi.id_karyawan')
            ->select('karyawan.nama', 'absensi.catatan AS aktivitas', 'absensi.created_at AS tanggal', DB::raw("'Absensi' AS jenis"))
            ->where('karyawan.id_karyawan', $id)
            ->union(
                DB::table('karyawan')
                    ->join('perizinan', 'karyawan.id_karyawan', '=', 'perizinan.id_karyawan')
                    ->select('karyawan.nama', 'perizinan.keterangan AS aktivitas', 'perizinan.created_at AS tanggal', DB::raw("'Perizinan' AS jenis"))
                    ->where('karyawan.id_karyawan', $id)
            )
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();



        //hitung jumlah absen
        $jumlah_absen = DB::table('absensi')
            ->where('id_karyawan', $id)
            ->count();

        //hitung jumlah izin
        $jumlah_izin = DB::table('perizinan')
            ->where('id_karyawan', $id)
            ->count();




        return view('hrd.karyawan.detail', compact('karyawan', 'type_menu', 'aktivitas', 'jumlah_absen', 'jumlah_izin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = 'karyawan-create';
        $divisi = DB::table('divisi')->get();
        $cabang = DB::table('cabang')->get();

        return view('hrd.karyawan.tambah', compact('type_menu', 'divisi', 'cabang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menyimpan file foto jika ada
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('images'), $fotoName);
        }

        // Mendapatkan nama depan
        $nama = explode(' ', $request->nama)[0];
        $ttl = explode(' ', $request->ttl)[0];

        $date = \DateTime::createFromFormat('Y-m-d', $ttl);
        if ($date) {
            $formattedDate = $date->format('dmy');
            $result = $nama . $formattedDate;
        } else {
            return back()->withErrors(['ttl' => 'Format tanggal tidak valid']);
        }

        // Menyimpan data ke tabel users dengan password yang diformat
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'ttl' => $request->ttl,
            'password' => bcrypt($result),
            'role' => 'karyawan',
        ]);

        // Menyimpan data ke tabel karyawan dan menangkap instance yang baru dibuat
        $karyawan = karyawan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_divisi' => $request->id_divisi,
            'id_cabang' => $request->id_cabang,
            'ttl' => $request->ttl,
            'no_hp' => $request->no_hp,
            'foto' => $fotoName,
            'id_users' => $user->id,
        ]);

        Alert::success('Berhasil', 'Data Karyawan Berhasil Ditambahkan');
        return redirect()->route('hrd_karyawan.show', $karyawan->id_karyawan);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $karyawan = karyawan::find($id);
        $type_menu = 'karyawan';

        if (!$karyawan) {
            // Jika karyawan tidak ditemukan, kembalikan error atau redirect
            return redirect()->back()->withErrors(['message' => 'Karyawan tidak ditemukan']);
        }

        return view('hrd.karyawan.tambah_foto', compact('karyawan', 'type_menu'));
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
        $karyawan = Karyawan::find($id);
        if ($karyawan) {
            Karyawan::find($id)->delete();
        }

        return redirect()->back();
    }
}
