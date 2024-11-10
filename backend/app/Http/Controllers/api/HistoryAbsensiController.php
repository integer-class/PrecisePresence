<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Carbon;


class HistoryAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $absensi = Absensi::where('id_karyawan', $request->id_karyawan)->get();

        if ($absensi->count() > 1) {
            return response()->json([
                'message' => 'success',
                'data' => $absensi
            ]);
        } else {
            return response()->json([
                'message' => 'no data found or only one entry',
                'data' => $absensi
            ]);
        }
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
