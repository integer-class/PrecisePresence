<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Cabang;
use App\Models\Karyawan;
use App\Models\Perizinan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HRD_dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type_menu = 'dashboard';

        $total_cabang = Cabang::count();
        $total_karyawan = karyawan::count();
        $total_perizinan = Perizinan::count();
        $absensi_terbaru = Absensi::orderBy('created_at', 'DESC')
            ->with('karyawan')
            ->limit(4)
            ->get();

        $label_statistik = [];
        $data_statistik = [];
        $now = Carbon::now()->subDays(7);
        for ($i = 0; $i < 7; $i++) {
            $absensi = Absensi::whereDate('waktu_absensi', $now->copy()->toDateString())
                ->groupBy('id_karyawan')
                ->count();
            array_push($label_statistik, $now->copy()->format('d M'));
            array_push($data_statistik, $absensi);
            $now->addDays(1);
        }

        $data['total_cabang'] = $total_cabang;
        $data['total_karyawan'] = $total_karyawan;
        $data['total_perizinan'] = $total_perizinan;
        $data['absensi_terbaru'] = $absensi_terbaru;
        $data['statistik']['label_statistik'] = json_encode($label_statistik);
        $data['statistik']['data_statistik'] = json_encode($data_statistik);

        Session::put('absensi_terbaru', json_encode($absensi_terbaru));

        return view('hrd.index', compact('type_menu', 'data'));
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
