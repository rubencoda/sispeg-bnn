<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Exports\DataPegawaiExport;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class DataPegawaiController extends Controller
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

    public function index(Request $request)
    {

        if ($request->has('search')) {
            $data = DataPegawai::where('nama_lengkap', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $data = DataPegawai::all();
        }

        return view('data-pegawai.view-pegawai', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = Role::all();
        return view('data-pegawai.add-pegawai', [
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi Form
        $request->validate([
            'pas_foto' => 'required|image',
            'nama_lengkap' => 'required',
            'no_hp' => 'required|min:10|max:12',
            'email' => 'required|email|unique:data_pegawais,email',
            'nip' => 'required|unique:data_pegawais,nip',
            'nik' => 'required|unique:data_pegawais,nik',
            'jabatan' => 'required',
            'pangkat_gol' => 'required',
            'alamat_rumah' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'ktp' => 'required|mimetypes:application/pdf|max:2048',
            'npwp' => 'required|mimetypes:application/pdf|max:2048',
            'sim_a' => 'nullable|mimetypes:application/pdf|max:2048',
            'sim_b' => 'nullable|mimetypes:application/pdf|max:2048',
            'sim_c' => 'required|mimetypes:application/pdf|max:2048',
            'paspor' => 'nullable|mimetypes:application/pdf|max:2048',
        ], [
            'pas_foto.required' => 'Pas Foto wajib diupload',
            'pas_foto.image' => 'File harus berformat gambar',
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi',
            'no_hp.required' => 'No. Handphone wajib diisi',
            'no_hp.min' => 'No. Handphone minimal 8 digit',
            'no_hp.max' => 'No. Handphone maksimal 12 digit',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email harus benar',
            'email.unique' => 'Email sudah digunakan',
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP Sudah digunakan',
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah digunakan',
            'jabatan.required' => 'Jabatan wajib dipilih',
            'pangkat_gol.required' => 'Pangkat/Gol wajib dipilih',
            'alamat_rumah.required' => 'Alamat Rumah wajib diisi',
            'tempatlahir.required' => 'Tempat Lahir wajib diisi',
            'tanggallahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'agama.required' => 'Agama wajib dipilih',
            'status_perkawinan' => 'Status Perkawinan wajib dipilih',
            'pendidikan_terakhir' => 'Pendidikan Terakhir wajib dipilih',
            'ktp.required' => 'KTP wajib upload file',
            'ktp.mimetypes' => 'File KTP harus menggunakan format .pdf',
            'ktp.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'npwp.required' => 'NPWP wajib upload file',
            'npwp.mimetypes' => 'File NPWP harus menggunakan format .pdf',
            'npwp.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'sim_a.mimetypes' => 'File SIM A harus menggunakan format .pdf',
            'sim_a.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'sim_b.mimetypes' => 'File SIM B harus menggunakan format .pdf',
            'sim_b.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'sim_c.required' => 'SIM C wajib upload file',
            'sim_c.mimetypes' => 'File SIM C harus menggunakan format .pdf',
            'sim_c.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'paspor.mimetypes' => 'File Paspor harus menggunakan format .pdf',
            'paspor.max' => 'Ukuran file yang diupload maksimal 2 MB',
        ]);

        // Insert Akun Pegawai
        $user = new User();
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make('Password01');
        $user->status_duty = 'Off Duty';
        $user->is_active = 'true';
        $user->save();

        // Pas Foto Proses
        $pas_foto_filename = $request->pas_foto->getClientOriginalName();
        $file_pas_foto = 'pas_foto/' . $pas_foto_filename;
        $request->pas_foto->storeAs('public/pas_foto', $pas_foto_filename);

        // KTP Proses
        $ktp_filename = $request->file('ktp');
        $file_ktp = $ktp_filename->store('ktp');

        // NPWP Proses
        $npwp_filename = $request->file('npwp');
        $file_npwp = $npwp_filename->store('npwp');

        // SIM A Proses
        if ($request->has('sim_a')) {
            $sim_a_filename = $request->file('sim_a');
            $file_sim_a = $sim_a_filename->store('sim_a');
        } else {
            $file_sim_a = null;
        }

        // SIM B Proses
        if ($request->has('sim_b')) {
            $sim_b_filename = $request->file('sim_b');
            $file_sim_b = $sim_b_filename->store('sim_b');
        } else {
            $file_sim_b = null;
        }

        // SIM C Proses
        $sim_c_filename = $request->file('sim_c');
        $file_sim_c = $sim_c_filename->store('sim_c');

        // Paspor Proses
        if ($request->has('paspor')) {
            $paspor_filename = $request->file('paspor');
            $file_paspor = $paspor_filename->store('paspor');
        } else {
            $file_paspor = null;
        }

        // Formatting Tempat Tanggal Lahir
        $tanggallahir = Carbon::createFromFormat('Y-m-d', $request->tanggallahir)->format('d-m-Y');
        $ttl = $request->tempatlahir . ", " . $tanggallahir;

        // Jabatan Integer
        $jabatan = intval($request->jabatan);

        // Insert Data Pegawai
        $data = new DataPegawai();
        $data->user_id = $user->id;
        $data->pas_foto = $file_pas_foto;
        $data->nama_lengkap = $request->nama_lengkap;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->nip = $request->nip;
        $data->role_id = $jabatan;
        $data->pangkat_gol = $request->pangkat_gol;
        $data->alamat_rumah = $request->alamat_rumah;
        $data->ttl = $ttl;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->agama = $request->agama;
        $data->status_perkawinan = $request->status_perkawinan;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->nik = $request->nik;
        $data->ktp = $file_ktp;
        $data->npwp = $file_npwp;
        $data->sim_a = $file_sim_a;
        $data->sim_b = $file_sim_b;
        $data->sim_c = $file_sim_c;
        $data->paspor = $file_paspor;
        $data->is_active = 'true';
        $data->save();

        $user->attachRole($jabatan); // Attach Role User

        if ($user && $data) {
            return redirect('/view-pegawai')->with('success', 'Data Pegawai berhasil ditambahkan');
        } else {
            return redirect('/view-pegawai')->with('error', 'Data Pegawai gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DataPegawai::find($id);
        $role = Role::all();

        // Seperated Tempat Tanggal Lahir
        $ttl = explode(', ', $data->ttl);

        $tempatlahir = $ttl[0];

        $tanggallahir = Carbon::parse($ttl[1])->format('Y-m-d');

        return view('data-pegawai.edit-pegawai', [
            'data' => $data,
            'role' => $role,
            'tempatlahir' => $tempatlahir,
            'tanggallahir' => $tanggallahir
        ]);
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
    public function update(Request $request)
    {
        // Validasi Form
        $request->validate([
            'nama_lengkap' => 'nullable',
            'pas_foto' => 'nullable|image',
            'no_hp' => 'required|min:10|max:12',
            'email' => 'nullable|email|unique:data_pegawais,email,' . $request->data_id,
            'nip' => 'required|unique:data_pegawais,nip,' . $request->data_id,
            'nik' => 'required|unique:data_pegawais,nik,' . $request->data_id,
            'jabatan' => 'required',
            'pangkat_gol' => 'required',
            'alamat_rumah' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'ktp' => 'nullable|mimetypes:application/pdf|max:2048',
            'npwp' => 'nullable|mimetypes:application/pdf|max:2048',
            'sim_a' => 'nullable|mimetypes:application/pdf|max:2048',
            'sim_b' => 'nullable|mimetypes:application/pdf|max:2048',
            'sim_c' => 'nullable|mimetypes:application/pdf|max:2048',
            'paspor' => 'nullable|mimetypes:application/pdf|max:2048',
        ], [
            'pas_foto.image' => 'File harus berformat gambar',
            'no_hp.required' => 'No. Handphone wajib diisi',
            'no_hp.min' => 'No. Handphone minimal 8 digit',
            'no_hp.max' => 'No. Handphone maksimal 12 digit',
            'email.email' => 'Format email harus benar',
            'email.unique' => 'Email sudah digunakan',
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP Sudah digunakan',
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah digunakan',
            'jabatan.required' => 'Jabatan wajib dipilih',
            'pangkat_gol.required' => 'Pangkat/Gol wajib dipilih',
            'alamat_rumah.required' => 'Alamat Rumah wajib diisi',
            'tempatlahir.required' => 'Tempat Lahir wajib diisi',
            'tanggallahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'agama.required' => 'Agama wajib dipilih',
            'status_perkawinan' => 'Status Perkawinan wajib dipilih',
            'pendidikan_terakhir' => 'Pendidikan Terakhir wajib dipilih',
            'ktp.mimetypes' => 'File KTP harus menggunakan format .pdf',
            'ktp.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'npwp.mimetypes' => 'File NPWP harus menggunakan format .pdf',
            'npwp.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'sim_a.mimetypes' => 'File SIM A harus menggunakan format .pdf',
            'sim_a.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'sim_b.mimetypes' => 'File SIM B harus menggunakan format .pdf',
            'sim_b.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'sim_c.mimetypes' => 'File SIM C harus menggunakan format .pdf',
            'sim_c.max' => 'Ukuran file yang diupload maksimal 2 MB',
            'paspor.mimetypes' => 'File Paspor harus menggunakan format .pdf',
            'paspor.max' => 'Ukuran file yang diupload maksimal 2 MB',
        ]);

        // Proses Update Pas Foto
        if ($request->pas_foto) {
            Storage::delete('public/' . $request->old_pas_foto);
            $pas_foto_filename = $request->pas_foto->getClientOriginalName();
            $file_pas_foto = 'pas_foto/' . $pas_foto_filename;
            $request->pas_foto->storeAs('public/pas_foto', $pas_foto_filename);
        } else {
            $file_pas_foto = $request->old_pas_foto;
        }

        // Proses Update KTP
        if ($request->ktp) {
            Storage::delete($request->old_ktp);
            $ktp_filename = $request->file('ktp');
            $file_ktp = $ktp_filename->store('ktp');
        } else {
            $file_ktp = $request->old_ktp;
        }

        // Proses Update NPWP
        if ($request->npwp) {
            Storage::delete($request->old_npwp);
            $npwp_filename = $request->file('npwp');
            $file_npwp = $npwp_filename->store('npwp');
        } else {
            $file_npwp = $request->old_npwp;
        }

        // Proses Update SIM A
        if ($request->sim_a) {
            Storage::delete($request->old_sim_a);
            $sim_a_filename = $request->file('sim_a');
            $file_sim_a = $sim_a_filename->store('sim_a');
        } else {
            $file_sim_a = $request->old_sim_a;
        }

        // Proses Update SIM B
        if ($request->sim_b) {
            Storage::delete($request->old_sim_b);
            $sim_b_filename = $request->file('sim_b');
            $file_sim_b = $sim_b_filename->store('sim_b');
        } else {
            $file_sim_b = $request->old_sim_b;
        }

        // Proses Update SIM C
        if ($request->sim_c) {
            Storage::delete($request->old_sim_c);
            $sim_c_filename = $request->file('sim_c');
            $file_sim_c = $sim_c_filename->store('sim_c');
        } else {
            $file_sim_c = $request->old_sim_c;
        }

        // Proses Update SIM B
        if ($request->paspor) {
            Storage::delete($request->old_paspor);
            $paspor_filename = $request->file('paspor');
            $file_paspor = $paspor_filename->store('paspor');
        } else {
            $file_paspor = $request->old_paspor;
        }

        // Proses Update Email dan Name
        if ($request->email !== null) {

            if ($request->nama_lengkap !== null) {
                $user = User::where('email', $request->old_email)->first();
                $user->email = $request->email;
                $user->name = $request->nama_lengkap;
                $user->update();

                $newnamalengkap = $request->nama_lengkap;
            } else {
                $user = User::where('email', $request->old_email)->first();
                $user->email = $request->email;
                $user->update();

                $newnamalengkap = $request->old_nama_lengkap;
            }

            $newemail = $request->email;
        } else {

            if ($request->nama_lengkap !== null) {
                $user = User::where('email', $request->old_email)->first();
                $user->name = $request->nama_lengkap;
                $user->update();

                $newnamalengkap = $request->nama_lengkap;
            } else {
                $newnamalengkap = $request->old_nama_lengkap;
            }

            $newemail = $request->old_email;
        }

        // Formatting Tempat Tanggal Lahir
        $tanggallahir = Carbon::createFromFormat('Y-m-d', $request->tanggallahir)->format('d-m-Y');
        $ttl = $request->tempatlahir . ", " . $tanggallahir;

        // Jabatan Integer
        $jabatan = intval($request->jabatan);

        $data = DataPegawai::find($request->data_id);

        $data->pas_foto = $file_pas_foto;
        $data->nama_lengkap = $newnamalengkap;
        $data->no_hp = $request->no_hp;
        $data->email = $newemail;
        $data->nip = $request->nip;
        $data->role_id = $jabatan;
        $data->pangkat_gol = $request->pangkat_gol;
        $data->alamat_rumah = $request->alamat_rumah;
        $data->ttl = $ttl;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->agama = $request->agama;
        $data->status_perkawinan = $request->status_perkawinan;
        $data->pendidikan_terakhir = $request->pendidikan_terakhir;
        $data->nik = $request->nik;
        $data->ktp = $file_ktp;
        $data->npwp = $file_npwp;
        $data->sim_a = $file_sim_a;
        $data->sim_b = $file_sim_b;
        $data->sim_c = $file_sim_c;
        $data->paspor = $file_paspor;
        // Role Update
        $role = User::find($data->user_id);
        $role->roles()->detach();
        $role->roles()->attach($jabatan);
        $data->update();

        if ($data) {
            return redirect('/view-pegawai')->with('success', 'Data Pegawai berhasil diubah');
        } else {
            return redirect('/view-pegawai')->with('error', 'Data Pegawai gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataPegawai::find($id);
        $data->is_active = 'false';
        $data->update();

        $user = User::find($data->user_id);
        $user->is_active = 'false';
        $user->update();

        if ($data && $user) {
            return redirect('/view-pegawai')->with('success', 'Data Pegawai berhasil di non-aktifkan');
        } else {
            return redirect('/view-pegawai')->with('error', 'Data Pegawai gagal di non-aktifkan');
        }
    }

    public function restore_data($id)
    {
        $data = DataPegawai::find($id);
        $data->is_active = 'true';
        $data->update();

        $user = User::find($data->user_id);
        $user->is_active = 'true';
        $user->update();

        if ($data && $user) {
            return redirect('/view-pegawai')->with('success', 'Data Pegawai berhasil diaktifkan');
        } else {
            return redirect('/view-pegawai')->with('error', 'Data Pegawai gagal diaktifkan');
        }
    }

    public function export()
    {
        $pegawai = DB::table('data_pegawais')
            ->join('roles', 'data_pegawais.role_id', '=', 'roles.id')
            ->select('data_pegawais.nama_lengkap', 'data_pegawais.nip', 'data_pegawais.pangkat_gol', 'roles.display_name as role', 'data_pegawais.no_hp')
            ->get();

        foreach ($pegawai as $item) {
            $data[] = ['nama_lengkap' => $item->nama_lengkap, 'nip' => strval($item->nip), 'pangkat_gol' => $item->pangkat_gol, 'role' => $item->pangkat_gol, 'no_hp' => $item->no_hp];
        }



        return Excel::download(new DataPegawaiExport($data), 'Data Pegawai.xlsx');
    }
}
