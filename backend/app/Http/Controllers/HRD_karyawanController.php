<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
// Model
use App\Models\Karyawan;

class HRD_karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'karyawan';
        $karyawan = karyawan::all();

        return view('hrd.karyawan.index', compact('karyawan', 'type_menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_menu = 'karyawan-create';

        return view('hrd.karyawan.tambah', compact('type_menu'));
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
            'divisi' => $request->kategori,
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
        //
    }
}
