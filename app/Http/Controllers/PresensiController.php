<?php

namespace App\Http\Controllers;

use App\Exports\PresensiExport;
use App\Models\DataPegawai;
use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $check_in = Carbon::parse($user->check_in_today);
        $check_out = Carbon::parse($user->check_out_today);

        if ($check_in->isToday()) {

            $showCheckin = false;

            if ($check_out->isToday()) {
                $showCheckout = false;
            } else {
                $showCheckout = true;
            }
        } else {
            $showCheckin = true;
            $showCheckout = false;
        }

        return view('presensi.presensi', [
            'showCheckin' => $showCheckin,
            'showCheckout' => $showCheckout
        ]);
    }

    public function dataView(Request $request)
    {

        if ($request->has('search')) {
            $search = $request->search;
            $data = Presensi::whereHas('Pegawai', function ($query) use ($search) {
                $query->where('nama_lengkap', 'LIKE', '%' . $search . '%');
            })->get();
        } else {
            $data = Presensi::all();
        }

        return view('presensi.view-presensi', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function check_in()
    {

        $user = Auth::user();

        // Checking check in hari ini
        $last_check_in = Carbon::parse($user->check_in_today)->format('Y-m-d');

        if ($last_check_in == Carbon::today()->toDateString()) {
            return redirect('/view-presensi')->with('error', 'Check-in sudah dilakukan');
        }

        $user->check_in_today = now();
        $user->status_duty = "On Duty";
        $user->save();

        if ($user) {
            return redirect('/view-presensi')->with('success', 'Check-in berhasil');
        } else {
            return redirect('/view-presensi')->with('error', 'Check-in gagal');
        }
    }

    public function check_out()
    {
        $check_in = Carbon::createFromTime(8, 0, 0);
        $check_out = Carbon::createFromTime(17, 0, 0);

        $totaljam = $check_in->diffInHours($check_out);

        $user = Auth::user();

        // Checking check out hari ini
        $last_check_out = Carbon::parse($user->check_out_today)->format('Y-m-d');

        if ($last_check_out == Carbon::today()->toDateString()) {
            return redirect('/view-presensi')->with('error', 'Check-out sudah dilakukan');
        }

        $user->check_out_today = now();
        $user->status_duty = "Off Duty";
        $user->save();

        $user_check_in = Carbon::parse($user->check_in_today);
        $user_check_out = Carbon::parse($user->check_out_today);

        $jamkerja = $user_check_in->diffInHours($user_check_out);

        if ($jamkerja >= $totaljam) {
            $keterangan = 'hadir';
            $user->hadir = $user->hadir + 1;
            $user->save();
        } else {
            $keterangan = 'tidak hadir';
            $user->tidak_hadir = $user->tidak_hadir + 1;
            $user->save();
        }
        $pegawai = DataPegawai::where('user_id', $user->id)->first();

        $presensi = new Presensi();
        $presensi->user_id = $user->id;
        $presensi->pegawai_id = $pegawai->id;
        $presensi->check_in = $user->check_in_today;
        $presensi->check_out = $user->check_out_today;
        $presensi->keterangan = $keterangan;
        $presensi->save();

        if ($presensi && $user) {
            return redirect('/view-presensi')->with('success', 'Check-out berhasil');
        } else {
            return redirect('/view-presensi')->with('error', 'Check-out gagal');
        }
    }

    public function export(Request $request)
    {
        $month = Carbon::parse($request->month)->format('m');
        $users = DataPegawai::all();

        foreach ($users as $user) {
            $tidakhadir = DB::table('presensis')
                ->join('data_pegawais', 'presensis.pegawai_id', '=', 'data_pegawais.id')
                ->select('data_pegawais.nama_lengkap as nama_lengkap', 'presensis.check_in', 'presensis.check_out', 'presensis.keterangan')
                ->whereMonth('presensis.created_at', $month)
                ->where('data_pegawais.id', $user->id)
                ->where('presensis.keterangan', 'tidak hadir')
                ->get()->count();

            $hadir = DB::table('presensis')
                ->join('data_pegawais', 'presensis.pegawai_id', '=', 'data_pegawais.id')
                ->select('data_pegawais.nama_lengkap as nama_lengkap', 'presensis.check_in', 'presensis.check_out', 'presensis.keterangan')
                ->whereMonth('presensis.created_at', $month)
                ->where('data_pegawais.id', $user->id)
                ->where('presensis.keterangan', 'hadir')
                ->get()->count();

            $cuti = DB::table('presensis')
                ->join('data_pegawais', 'presensis.pegawai_id', '=', 'data_pegawais.id')
                ->select('data_pegawais.nama_lengkap as nama_lengkap', 'presensis.check_in', 'presensis.check_out', 'presensis.keterangan')
                ->whereMonth('presensis.created_at', $month)
                ->where('data_pegawais.id', $user->id)
                ->where('presensis.keterangan', 'cuti')
                ->get()->count();

            $data[] = ['nama' => $user->nama_lengkap, 'nip/nrp' => strval($user->nip), 'hadir' => strval($hadir), 'tidak hadir' => strval($tidakhadir), 'cuti' => strval($cuti), 'bulan' => Carbon::parse($request->month)->format('M')];
        }
        return Excel::download(new PresensiExport($data), 'Data Presensi Pegawai.xlsx');
    }
}
