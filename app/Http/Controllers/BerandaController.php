<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $offduty = User::where('status_duty', 'Off Duty')->count();
        $onduty = User::where('status_duty', 'On Duty')->count();
        $cuti = User::where('status_duty', 'Off Duty Cuti')->count();
        $pegawai = DataPegawai::count();
        return view('beranda', [
            'offduty' => $offduty,
            'onduty' => $onduty,
            'cuti' => $cuti,
            'pegawai' => $pegawai
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

    public function updatePassword(Request $request)
    {

        # Validation
        // $request->validate([
        //     'old_password' => 'required',
        //     'new_password' => 'required|confirmed',
        // ]);

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.required' => 'Password Lama Wajib Diisi',
            'new_password.required' => 'Password Baru Wajib Diisi',
            'new_password.confirmed' => 'Password Baru Tidak Sama'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        #Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "Password Lama Tidak Sama");
        }

        #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password berhasil Dirubah");
    }
}
