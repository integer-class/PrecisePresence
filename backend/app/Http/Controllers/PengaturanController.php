<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Cabang;
use App\Models\Divisi;
use App\Models\JenisAbsensi;
use Illuminate\Support\Facades\DB;
use App\Models\JadwalAbsensi;




class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $type_menu = 'pengaturan';
        return view('hrd.pengaturan.index', compact('type_menu'));
    }

    public function cabang()
    {

        $type_menu = 'pengaturan';
        $cabang = Cabang::all();
        return view('hrd.pengaturan.cabang', compact('type_menu', 'cabang'));
    }
    //detail cabang
    public function detailCabang($id)
    {
        $type_menu = 'pengaturan';
        $cabang = Cabang::where('id_cabang', $id)->first();
        return view('hrd.pengaturan.detail_cabang', compact('type_menu', 'cabang'));
    }


    public function buatCabang()
    {
        $type_menu = 'pengaturan';
        return view('hrd.pengaturan.add_cabang', compact('type_menu'));
    }
    public function buatDivisi()
    {
        $type_menu = 'pengaturan';
        $jenis_absensi = JenisAbsensi::all();
        return view('hrd.pengaturan.add_divisi', compact('type_menu', 'jenis_absensi'));
    }

    public function simpanDivisi(Request $request)
    {
       // Validasi input
    $validated = $request->validate([
        'nama_divisi' => 'required|string|max:255',
        'jenis_absensi' => 'required|array',
        'jenis_absensi.*' => 'exists:jenis_absensi,id_jenis_absensi',
        'waktu' => 'required|array',
        'waktu.*' => 'date_format:H:i',
    ]);

    try {
        // Mulai transaksi database
        DB::beginTransaction();

        // Simpan divisi
        $divisi = Divisi::create([
            'nama_divisi' => $validated['nama_divisi'],
        ]);

        // Simpan jadwal absensi
        foreach ($validated['jenis_absensi'] as $key => $idJenisAbsensi) {
            JadwalAbsensi::create([
                'id_divisi' => $divisi->id_divisi,
                'id_jenis_absensi' => $idJenisAbsensi,
                'waktu' => $validated['waktu'][$key],
            ]);
        }

        // Commit transaksi jika semua berhasil
        DB::commit();

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    } catch (\Exception $e) {
        // Rollback jika terjadi kesalahan
        DB::rollBack();

        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
    }

    public function saveCabang(Request $request)
{
    // Validasi data yang diterima
    $validated = $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'radius' => 'required|integer',
        'nama_cabang' => 'required|string|max:255',
        'alamat_cabang' => 'required|string|max:255',
        'foto_cabang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
    ]);

    // Simpan data cabang baru ke database
    $cabang = new Cabang();
    $cabang->latitude = $validated['latitude'];
    $cabang->longitude = $validated['longitude'];
    $cabang->radius = $validated['radius'];
    $cabang->nama_cabang = $validated['nama_cabang'];
    $cabang->alamat_cabang = $validated['alamat_cabang'];

    // Check if a file is uploaded
    if ($request->hasFile('foto_cabang')) {
        $fotoCabang = time() . '_' . $request->file('foto_cabang')->getClientOriginalName();
        $request->file('foto_cabang')->move(public_path('images'), $fotoCabang);
        $cabang->foto_cabang = 'images/' . $fotoCabang; // Store the path in the database
    }

    $cabang->save();

    // Response berhasil
    return response()->json([
        'message' => 'Cabang berhasil disimpan!'
    ]);
}


public function general()
{
    $type_menu = 'pengaturan';
    $divisi = Divisi::all();
    return view('hrd.pengaturan.general', compact('type_menu', 'divisi'));
}


public function jenis_absensi()
{
    $type_menu = 'pengaturan';
    $jenis_absensi = JenisAbsensi::all();
    return view('hrd.pengaturan.jenis_absensi', compact('type_menu', 'jenis_absensi'));
}

public function tambahjenis(Request $request)
{
    $validated = $request->validate([
        'nama_jenis_absensi' => 'required|string|max:255',
        'aturan_waktu' => 'required|string|max:2',

    ]);

    JenisAbsensi::create($validated);

    return redirect()->route('hrd.pengaturan.jenis_absensi')->with('success', 'Jenis Absensi berhasil ditambahkan.');

}

    public function editdivisi($id)
        {
            $type_menu = 'pengaturan';
            $divisi = Divisi::where('id_divisi', $id)->first();
            return view('hrd.pengaturan.edit_divisi', compact('type_menu', 'divisi'));

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
         // Validasi data input
        $validatedData = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'required|integer|min:1',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
        ]);

        // Simpan data ke database dengan metode create
        $setting = Setting::create($validatedData);

        // Kirim respon
        return response()->json([
            'message' => 'Pengaturan berhasil disimpan!',
            'data' => $setting
        ], 201);
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
