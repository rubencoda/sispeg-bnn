<?php

namespace App\Http\Controllers;

use App\Mail\CutiEmail;
use App\Models\Cuti;
use App\Models\DataPegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\JenisCutiModel;
use App\Models\SKBCuti;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class PerizinanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function isNationalHoliday($date)
    {
        $month = $date->format('m');
        $year = $date->format('Y');

        $client = new Client();
        $response = $client->request('GET', 'https://api-harilibur.vercel.app/api', [
            'query' => [
                'month' => $month,
                'year' => $year
            ]
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        foreach ($responseData as $item) {
            if ($item['is_national_holiday'] && $item['holiday_date'] === $date->format('Y-m-d')) {
                return true;
            }
        }

        return false;
    }

    function getSKB($date)
    {
        $month = $date->format('m');
        $year = $date->format('Y');

        $results = SKBCuti::whereMonth('tanggal_skb', $month)
            ->whereYear('tanggal_skb', $year)
            ->get();

        foreach ($results as $item) {
            if ($item->tanggal_skb === $date->format('Y-m-d')) {
                return true;
            }
        }

        return false;
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('KEPALA-BNNK-SIDOARJO')) {
            $data = Cuti::where('status_cuti', 'Need Approval 2')->get();
        } else {
            $data = Cuti::where('status_cuti', 'Need Approval 1')->get();
        }
        return view('perizinan-cuti.view-datacuti', [
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
        $data = DataPegawai::where('user_id', Auth::user()->id)->first();
        $jeniscuti = JenisCutiModel::all();
        return view('perizinan-cuti.add-datacuti', [
            'data' => $data,
            'jeniscuti' => $jeniscuti
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
        $user = Auth::user();
        $cuti = JenisCutiModel::find($request->jenis_cuti);

        // Validasi Form
        $request->validate([
            'nip_nrp' => 'required',
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'jenis_cuti' => 'required',
            'alamat_cuti' => 'required'
        ], [
            'nip_nrp.required' => 'NIP/NRP wajib diisi',
            'nama_pegawai.required' => 'Nama Pegawai wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'jenis_cuti.required' => 'Jenis Cuti wajib dipilih',
            'alamat_cuti.required' => 'Alamat selama suci wajib diisi',
        ]);

        if ($cuti->type_cuti == "Jatah Cuti") {

            if ($user->sisa_cuti < $cuti->total_hari) {
                return back()->with('error', 'Pengajuan gagal ditambahkan karena sisa cuti anda tidak mencukupi');
            }
        }

        if ($request->catatan_cuti) {
            $catatan_cuti  = $request->catatan_cuti;
        } else {
            $catatan_cuti = null;
        }

        $mulaicuti = Carbon::parse($request->mulai_cuti);
        $mulaicuti_temp = Carbon::parse($request->mulai_cuti);
        $total_hari = $cuti->total_hari;
        $akhircuti = Carbon::parse($request->mulai_cuti)->addDays($total_hari - 1);

        // Seleksi Akhir Cuti
        while ($mulaicuti <= $akhircuti) {
            if ($mulaicuti->isWeekend() || $this->isNationalHoliday($mulaicuti) || $this->getSKB($mulaicuti)) {
                $akhircuti->addDay();
            }
            $mulaicuti->addDay();
        }

        $data = new Cuti();
        $data->user_id = Auth::user()->id;
        $data->nip = $request->nip_nrp;
        $data->nama_pegawai = $request->nama_pegawai;
        $data->jabatan = $request->jabatan;
        $data->jenis_cuti = $request->jenis_cuti;
        $data->catatan_cuti = $catatan_cuti;
        $data->alamat_cuti = $request->alamat_cuti;
        $data->status_cuti = 'Need Approval 1';
        $data->mulai_cuti = $mulaicuti_temp;
        $data->akhir_cuti = $akhircuti;
        $data->save();

        if ($data) {
            return back()->with('success', 'Pengajuan Cuti berhasil ditambahkan');
        } else {
            return back()->with('error', 'Pengajuan gagal ditambahkan');
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

    public function first_approve($id)
    {
        $data = Cuti::find($id);
        $data->status_cuti = "Need Approval 2";
        $data->save();

        if ($data) {
            return redirect('/view-cuti')->with('success', 'Perizinan Cuti berhasil dikonfirmasi');
        } else {
            return redirect('/view-cuti')->with('error', 'Perizinan Cuti gagal dikonfirmasi');
        }
    }

    public function second_approve($id)
    {
        $data = Cuti::find($id);
        $type_cuti = $data->JenisCuti->type_cuti;
        $total_hari = $data->JenisCuti->total_hari;
        $akhircuti = $data->akhir_cuti;

        $user = User::find($data->user_id);

        switch ($type_cuti) {

            case 'Non Jatah Cuti':
                $user->status_duty = "Off Duty Cuti";
                $user->akhir_cuti = $akhircuti;
                $user->cuti = $user->cuti + $total_hari;
                $user->save();
                break;
            case 'Jatah Cuti':
                $user->status_duty = "Off Duty Cuti";
                $user->sisa_cuti = $user->sisa_cuti - $total_hari;
                $user->cuti = $user->cuti + $total_hari;
                $user->akhir_cuti = $akhircuti;
                $user->save();
                break;
        };

        $data->status_cuti = "Approved";
        $data->save();

        $kepalabnn = DataPegawai::whereHas('role', function ($query) {
            $query->where('name', 'KEPALA-BNNK-SIDOARJO');
        })->get()->toArray();

        $kepalasubbag = DataPegawai::whereHas('role', function ($query) {
            $query->where('name', 'KEPALA-SUB-BAGIAN-UMUM');
        })->get()->toArray();

        // Generate the PDF
        $pdf = PDF::loadView('pdf.surat-cuti', [
            'data' => $data,
            'kepalabnn' => $kepalabnn,
            'kepalasubbag' => $kepalasubbag
        ]);

        $attatch = [
            'email' => $data->User->email,
            'title' => 'Perizinan Cuti'
        ];

        $email = Mail::send('email.cuti-email', ['data' => $data], function ($message) use ($attatch, $pdf) {
            $message->to($attatch['email'])
                ->subject($attatch['title'])
                ->attachData($pdf->output(), "Surat Izin Cuti.pdf");
        });

        if ($data && $email) {
            return redirect('/view-cuti')->with('success', 'Perizinan Cuti berhasil dikonfirmasi');
        } else {
            return redirect('/view-cuti')->with('error', 'Perizinan Cuti gagal dikonfirmasi');
        }
    }

    public function rejected($id)
    {

        $data = Cuti::find($id);
        $data->status_cuti = "Rejected";
        $data->save();

        $attatch = [
            'email' => $data->User->email,
            'title' => 'Perizinan Cuti'
        ];

        $email = Mail::send('email.reject-cuti-email', ['data' => $data], function ($message) use ($attatch) {
            $message->to($attatch['email'])
                ->subject($attatch['title']);
        });

        if ($data && $email) {
            return redirect('/view-cuti')->with('success', 'Perizinan Cuti berhasil dikonfirmasi');
        } else {
            return redirect('/view-cuti')->with('error', 'Perizinan Cuti gagal dikonfirmasi');
        }
    }

    public function status_cuti()
    {
        $data = Cuti::where('user_id', Auth::user()->id)->get();
        return view('perizinan-cuti.status-datacuti', [
            'data' => $data
        ]);
    }

    public function history_cuti()
    {
        $data = Cuti::whereIn('status_cuti', ['Approved', 'Rejected'])->get();

        return view('perizinan-cuti.history-datacuti', [
            'data' => $data
        ]);
    }

    public function jenis_cuti()
    {

        $data = JenisCutiModel::all();
        return view('perizinan-cuti.jenis-cuti', [
            'data' => $data
        ]);
    }

    public function insert_jenis_cuti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_cuti' => 'required',
            'type_cuti' => 'required',
            'total_hari' => 'required'
        ], [
            'nama_cuti.required' => 'Nama Cuti Wajib Diisi',
            'type_cuti.required' => 'Type Cuti Wajib Dipilih',
            'total_cuti.required' => 'Total Hari Wajib Diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new JenisCutiModel;
        $data->nama_cuti = $request->nama_cuti;
        $data->type_cuti = $request->type_cuti;
        $data->total_hari = $request->total_hari;
        $data->save();

        if ($data) {
            return redirect('/view-jenis-cuti')->with('success', 'Jenis Cuti berhasil ditambahkan');
        } else {
            return redirect('/view-jenis-cuti')->with('error', 'Jenis Cuti gagal ditambahkan');
        }
    }

    public function update_jenis_cuti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_cuti' => 'required',
            'type_cuti' => 'required',
            'total_hari' => 'required'
        ], [
            'nama_cuti.required' => 'Nama Cuti Wajib Diisi',
            'type_cuti.required' => 'Type Cuti Wajib Dipilih',
            'total_cuti.required' => 'Total Hari Wajib Diisi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = JenisCutiModel::find($request->id_jenis_cuti);
        $data->nama_cuti = $request->nama_cuti;
        $data->type_cuti = $request->type_cuti;
        $data->total_hari = $request->total_hari;
        $data->update();

        if ($data) {
            return redirect('/view-jenis-cuti')->with('success', 'Jenis Cuti berhasil diubah');
        } else {
            return redirect('/view-jenis-cuti')->with('error', 'Jenis Cuti gagal diubah');
        }
    }

    public function delete_jenis_cuti($id)
    {
        $data = JenisCutiModel::find($id);
        $data->delete();

        if ($data) {
            return redirect('/view-jenis-cuti')->with('success', 'Jenis Cuti berhasil dihapus');
        } else {
            return redirect('/view-jenis-cuti')->with('error', 'Jenis Cuti gagal dihapus');
        }
    }

    public function ttd_kepalacabang()
    {
        return view('perizinan-cuti.ttd-kepalacabang');
    }

    public function store_ttd_kc(Request $request)
    {
        $filename = 'ttd_kepalacabang.png';
        $upload = $request->ttd_kepalacabang->storeAs('public/ttd', $filename);

        if ($upload) {
            return redirect('/ttd-kepalacabang')->with('success', 'Tanda Tangan berhasil diupdate');
        } else {
            return redirect('/ttd-kepalacabang')->with('error', 'Tanda Tangan gagal diupdate');
        }
    }

    public function ttd_kasubag()
    {
        return view('perizinan-cuti.ttd-kasubag');
    }

    public function store_ttd_kasubag(Request $request)
    {
        $filename = 'ttd_kasubag.png';
        $upload = $request->ttd_kasubag->storeAs('public/ttd', $filename);

        if ($upload) {
            return redirect('/ttd-kasubag')->with('success', 'Tanda Tangan berhasil diupdate');
        } else {
            return redirect('/ttd-kasubag')->with('error', 'Tanda Tangan gagal diupdate');
        }
    }

    public function index_skb_cuti()
    {
        $data = SKBCuti::all();
        return view('skb.view-skb', [
            'data' => $data
        ]);
    }

    public function store_skb_cuti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_skb_cuti' => 'required',
            'tgl_skb_cuti' => 'required',
        ], [
            'nama_skb_cuti.required' => 'Nama SKB Cuti Wajib Diisi',
            'tgl_skb_cuti.required' => 'Tanggal SKB Cuti Wajib Diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = new SKBCuti();
        $data->nama_skb = $request->nama_skb_cuti;
        $data->tanggal_skb = $request->tgl_skb_cuti;
        $data->save();

        if ($data) {
            return redirect('/view-skb-cuti')->with('success', 'SKB Cuti berhasil ditambah');
        } else {
            return redirect('/view-skb-cuti')->with('error', 'SKB Cuti gagal ditambah');
        }
    }

    public function update_skb_cuti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_skb_cuti' => 'required',
            'tgl_skb_cuti' => 'required',
        ], [
            'nama_skb_cuti.required' => 'Nama SKB Cuti Wajib Diisi',
            'tgl_skb_cuti.required' => 'Tanggal SKB Cuti Wajib Diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = SKBCuti::find($request->id_skb_cuti);
        $data->nama_skb = $request->nama_skb_cuti;
        $data->tanggal_skb = $request->tgl_skb_cuti;
        $data->update();

        if ($data) {
            return redirect('/view-skb-cuti')->with('success', 'SKB Cuti berhasil diupdate');
        } else {
            return redirect('/view-skb-cuti')->with('error', 'SKB Cuti gagal diupdate');
        }
    }

    public function delete_skb_cuti($id)
    {
        $data = SKBCuti::find($id);
        $data->delete();

        if ($data) {
            return redirect('/view-skb-cuti')->with('success', 'SKB Cuti berhasil dihapus');
        } else {
            return redirect('/view-skb-cuti')->with('error', 'SKB Cuti gagal dihapus');
        }
    }
}
