<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class history extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::where('id_karyawan', auth()->user()->karyawan->id_karyawan)->get();



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

    public function cek(Request $request)
{
    $today = Carbon::today();
    $absensi = Absensi::where('id_karyawan', $request->id_karyawan)
        ->whereDate('check_in_time', $today)
        ->first();

    if (!$absensi) {
        return response()->json([
            'message' => 'belum check-in',
        ]);
    }
    if ($absensi->status == 'checkin') {
        return response()->json([
            'message' => 'sudah check-in, belum checkout',
        ]);
    } elseif ($absensi->status == 'checkout') {
        return response()->json([
            'message' => 'sudah checkout.',
        ]);
    }
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
