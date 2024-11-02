<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perizinan;
//validator
use Illuminate\Support\Facades\Validator;

class PerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'perizinan';


        //hitung jumlah data
        $jumlah_data = Perizinan::count();
        //ambil data perizinan
        $perizinan = Perizinan::select('perizinan.*', 'karyawan.nama')
        ->join ('karyawan', 'perizinan.id_karyawan', '=', 'karyawan.id_karyawan')
        ->get();
        return view('hrd.perizinan.index', compact('type_menu', 'jumlah_data', 'perizinan'));


    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_izin' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'dokumen_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only([
            'jenis_izin', 'tanggal_mulai', 'tanggal_selesai',
            'keterangan', 'id_karyawan'
        ]);

        // Set status sebagai 'pending' secara default
        $data['status'] = 'pending';

        // Upload file jika ada dokumen pendukung
        if ($request->hasFile('dokumen_pendukung')) {
            $path = $request->file('dokumen_pendukung')->store('dokumen_pendukung');
            $data['dokumen_pendukung'] = $path;
        }

        $perizinan = Perizinan::create($data);

        return response()->json([
            'message' => 'Perizinan berhasil ditambahkan.',
            'data' => $perizinan,
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
