<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPegawaiExport implements FromCollection, WithHeadings
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
    //     return DB::table('data_pegawais')
    //         ->join('roles', 'data_pegawais.role_id', '=', 'roles.id')
    //         ->select('data_pegawais.nama_lengkap', 'data_pegawais.nip', 'data_pegawais.pangkat_gol', 'roles.display_name as role', 'data_pegawais.no_hp')
    //         ->get();
    // }

    public function collection()
    {
        $formattedData = collect($this->data)->map(function ($row) {
            $row['nip'] = "'" . $row['nip']; // Prepend with a single quotation mark
            return $row;
        });

        return $formattedData;
    }

    public function map($row): array
    {
        return [
            $row['nama_lengkap'],
            $row['nip'],
            $row['pangkat_gol'],
            $row['role'],
            $row['no_hp'],
        ];
    }

    public function headings(): array
    {
        return ["Nama Lengkap", "NIP/NRP", "Pangkat / Gol", "Jabatan", "No.Handphone"];
    }
}
