<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perizinan;
//validator
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
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
        $jumlah_data_pending = Perizinan::where('status', 'pending')->count();
        $jumlah_data_diterima = Perizinan::where('status', 'approved')->count();
        $jumlah_data_ditolak = Perizinan::where('status', 'rejected')->count();





        $perizinan = Perizinan::select('perizinan.*', 'karyawan.nama')
        ->join ('karyawan', 'perizinan.id_karyawan', '=', 'karyawan.id_karyawan')
        ->get();
        return view('hrd.perizinan.index', compact('type_menu', 'jumlah_data', 'perizinan', 'jumlah_data_pending', 'jumlah_data_diterima', 'jumlah_data_ditolak'));


    }




    public function getperizinan()
    {
        // Get id_karyawan from the authenticated user
        $idKaryawan = auth()->user()->karyawan->id_karyawan;

        $perizinan = Perizinan::where('id_karyawan', $idKaryawan)->get();

        return response()->json($perizinan);

        return response()->json([
            'message' => 'success',
            'data' => $perizinan,
        ], 200);
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
        // Get id_karyawan from the authenticated user
        $idKaryawan = auth()->user()->karyawan->id_karyawan;

        $validator = Validator::make($request->all(), [
            'jenis_izin' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
            'dokumen_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:50000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check if the employee has already applied for leave in the same date range
        $izin = Perizinan::where('id_karyawan', $idKaryawan)
            ->where('tanggal_mulai', '<=', $request->tanggal_selesai)
            ->where('tanggal_selesai', '>=', $request->tanggal_mulai)
            ->where('status', 'pending')
            ->first();

        if ($izin) {
            return response()->json([
                'message' => 'Karyawan sudah pernah mengajukan izin pada tanggal tersebut.',
            ], 422);
        }

        $data = $request->only([
            'jenis_izin', 'tanggal_mulai', 'tanggal_selesai',
            'keterangan'
        ]);

        // Add id_karyawan to the data
        $data['id_karyawan'] = $idKaryawan;

        // Set status as 'pending' by default
        $data['status'] = 'pending';

        // Upload file if available
        if ($request->hasFile('dokumen_pendukung')) {
            $file = $request->file('dokumen_pendukung');
            $imageName = $file->getClientOriginalName();
            $filePath = $file->move(public_path('dokumen_pendukung'), $imageName);
            $data['dokumen_pendukung'] = 'dokumen_pendukung/' . $imageName;
        }

        // Create the perizinan record
        $perizinan = Perizinan::create($data);

        return response()->json([
            'message' => 'Perizinan berhasil ditambahkan.',
            'data' => $perizinan,
        ], 201);
    }


       public function approve($id)
       {
           $perizinan = Perizinan::findOrFail($id);

           $perizinan->status = 'approved';
           $perizinan->save();

           return redirect()->back()->with('success', 'Request approved successfully.');
       }

       public function reject($id)
       {
           $perizinan = Perizinan::findOrFail($id);

           $perizinan->status = 'rejected';
           $perizinan->save();

           return redirect()->back()->with('error', 'Request rejected.');
       }


    public function diterima()
    {
        $type_menu = 'perizinan';


        //hitung jumlah data
        $jumlah_data = Perizinan::count();
        $jumlah_data_pending = Perizinan::where('status', 'pending')->count();
        $jumlah_data_diterima = Perizinan::where('status', 'approved')->count();
        $jumlah_data_ditolak = Perizinan::where('status', 'rejected')->count();





        $perizinan = Perizinan::select('perizinan.*', 'karyawan.nama')
        ->join ('karyawan', 'perizinan.id_karyawan', '=', 'karyawan.id_karyawan')
        ->where('status', 'approved')
        ->get();
        return view('hrd.perizinan.diterima', compact('type_menu', 'jumlah_data', 'perizinan', 'jumlah_data_pending', 'jumlah_data_diterima', 'jumlah_data_ditolak'));
    }
    public function pending()
    {
        $type_menu = 'perizinan';


        //hitung jumlah data
        $jumlah_data = Perizinan::count();
        $jumlah_data_pending = Perizinan::where('status', 'pending')->count();
        $jumlah_data_diterima = Perizinan::where('status', 'approved')->count();
        $jumlah_data_ditolak = Perizinan::where('status', 'rejected')->count();





        $perizinan = Perizinan::select('perizinan.*', 'karyawan.nama')
        ->join ('karyawan', 'perizinan.id_karyawan', '=', 'karyawan.id_karyawan')
        ->where('status', 'pending')
        ->get();
        return view('hrd.perizinan.pending', compact('type_menu', 'jumlah_data', 'perizinan', 'jumlah_data_pending', 'jumlah_data_diterima', 'jumlah_data_ditolak'));
    }
    public function ditolak()
    {
        $type_menu = 'perizinan';


        //hitung jumlah data
        $jumlah_data = Perizinan::count();
        $jumlah_data_pending = Perizinan::where('status', 'pending')->count();
        $jumlah_data_diterima = Perizinan::where('status', 'approved')->count();
        $jumlah_data_ditolak = Perizinan::where('status', 'rejected')->count();





        $perizinan = Perizinan::select('perizinan.*', 'karyawan.nama')
        ->join ('karyawan', 'perizinan.id_karyawan', '=', 'karyawan.id_karyawan')
        ->where('status', 'rejected')
        ->get();
        return view('hrd.perizinan.ditolak', compact('type_menu', 'jumlah_data', 'perizinan', 'jumlah_data_pending', 'jumlah_data_diterima', 'jumlah_data_ditolak'));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $type_menu = 'perizinan';
        $perizinan = Perizinan::where('id', $id)->first();


        $id_karyawan = $perizinan->id_karyawan;


        $karyawan = karyawan::join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
        ->where('karyawan.id_karyawan', $id_karyawan)
        ->select('karyawan.*', 'divisi.nama_divisi')
        ->first();

        $aktivitas = DB::table('karyawan')
        ->join('absensi', 'karyawan.id_karyawan', '=', 'absensi.id_karyawan')
        ->select('karyawan.nama', 'absensi.catatan AS aktivitas', 'absensi.created_at AS tanggal', DB::raw("'Absensi' AS jenis"))
        ->where('karyawan.id_karyawan', $id_karyawan)
        ->union(
            DB::table('karyawan')
                ->join('perizinan', 'karyawan.id_karyawan', '=', 'perizinan.id_karyawan')
                ->select('karyawan.nama', 'perizinan.keterangan AS aktivitas', 'perizinan.created_at AS tanggal', DB::raw("'Perizinan' AS jenis"))
                ->where('karyawan.id_karyawan', $id_karyawan)
        )
        ->orderBy('tanggal', 'desc')
        ->limit(5)
        ->get();



        //hitung jumlah absen
        $jumlah_absen = DB::table('absensi')
        ->where('id_karyawan', $id_karyawan)
        ->count();

        //hitung jumlah izin
        $jumlah_izin = DB::table('perizinan')
        ->where('id_karyawan', $id_karyawan)
        ->count();





        return view('hrd.perizinan.detail', compact('type_menu', 'perizinan','karyawan', 'aktivitas', 'jumlah_absen', 'jumlah_izin'));

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
