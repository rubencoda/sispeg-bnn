<?php

namespace App\Exports;

// use App\Models\Presensi;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PresensiExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     // return DB::table('presensis')
    //     //     ->join('data_pegawais', 'presensis.pegawai_id', '=', 'data_pegawais.id')
    //     //     ->select('data_pegawais.nama_lengkap as nama_lengkap', 'presensis.check_in', 'presensis.check_out', 'presensis.keterangan')
    //     //     ->get();
    //     return collect($this->data);
    // }

    public function collection()
    {
        $formattedData = collect($this->data)->map(function ($row) {
            $row['nip/nrp'] = "'" . $row['nip/nrp']; // Prepend with a single quotation mark
            return $row;
        });

        return $formattedData;
    }

    public function map($row): array
    {
        return [
            $row['nama'],
            $row['nip/nrp'],
            $row['hadir'],
            $row['tidak hadir'],
            $row['cuti'],
            $row['bulan'],
        ];
    }
    public function headings(): array
    {
        return ["Nama Pegawai", 'NIP/ NRP', "Hadir", "Tidak Hadir", "Cuti", 'Bulan'];
    }
}
