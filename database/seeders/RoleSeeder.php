<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'name' => 'superadmin',
                'display_name' => 'Super Admin',
                'description' => 'Super Admin',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'KEPALA-BNNK-SIDOARJO',
                'display_name' => 'KEPALA BNNK SIDOARJO',
                'description' => 'KEPALA BNNK SIDOARJO',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'KEPALA-SUB-BAGIAN-UMUM',
                'display_name' => 'KEPALA SUB BAGIAN UMUM',
                'description' => 'KEPALA SUB BAGIAN UMUM',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'KONSELOR-ADIKSI-AHLI-MUDA',
                'display_name' => 'KONSELOR ADIKSI AHLI MUDA',
                'description' => 'KONSELOR ADIKSI AHLI MUDA',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PENYUSUN-PROGRAM-ANGGARAN-DAN-PELAPORAN',
                'display_name' => 'PENYUSUN PROGRAM ANGGARAN DAN PELAPORAN',
                'description' => 'PENYUSUN PROGRAM ANGGARAN DAN PELAPORAN',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'ANALIS-PENYULUHAN-DAN-LAYANAN-INFORMASI',
                'display_name' => 'ANALIS PENYULUHAN DAN LAYANAN INFORMASI',
                'description' => 'ANALIS PENYULUHAN DAN LAYANAN INFORMASI',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'ANALIS-PEMBERDAYAAN-MASYARAKAT',
                'display_name' => 'ANALIS PEMBERDAYAAN MASYARAKAT',
                'description' => 'ANALIS PEMBERDAYAAN MASYARAKAT',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PENYULUH-NARKOBA-AHLI-MUDA',
                'display_name' => 'PENYULUH NARKOBA AHLI MUDA',
                'description' => 'PENYULUH NARKOBA AHLI MUDA',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'ANALIS-INTELIJEN',
                'display_name' => 'ANALIS INTELIJEN',
                'description' => 'ANALIS INTELIJEN',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'ANALIS-DATA-DAN-INFORMASI',
                'display_name' => 'ANALISDATA DAN INFORMASI',
                'description' => 'ANALIS DATA DAN INFORMASI',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PENGELOLA-DATA-SUB-BAGIAN-UMUM',
                'display_name' => 'PENGELOLA DATA SUB BAGIAN UMUM',
                'description' => 'PENGELOLA DATA SUB BAGIAN UMUM',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PENGELOLA-KEUANGAN',
                'display_name' => 'PENGELOLA KEUANGAN',
                'description' => 'PENGELOLA KEUANGAN',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PRANATA-KEUANGAN-APBN-MAHIR',
                'display_name' => 'PRANATA KEUANGAN APBN MAHIR',
                'description' => 'PRANATA KEUANGAN APBN MAHIR',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PENGADMINISTRASI-UMUM-SUB-BAGIAN-UMUM',
                'display_name' => 'PENGADMINISTRASI UMUM SUB BAGIAN UMUM',
                'description' => 'PENGADMINISTRASI UMUM SUB BAGIAN UMUM',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'ASISTEN-KONSELOR-ADIKSI-TERAMPIL',
                'display_name' => 'ASISTEN KONSELOR ADIKSI TERAMPIL',
                'description' => 'ASISTEN KONSELOR ADIKSI TERAMPIL',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PETUGAS-KEAMANAN',
                'display_name' => 'PETUGAS KEAMANAN',
                'description' => 'PETUGAS KEAMANAN',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PENYULUH-NON-PNS',
                'display_name' => 'PENYULUH NON PNS',
                'description' => 'PENYULUH NON PNS',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'FASILITATOR-REHABILITASI-NON-PNS',
                'display_name' => 'FASILITATOR REHABILITASI NON PNS',
                'description' => 'FASILITATOR REHABILITASI NON PNS',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PRAMU-BAKTI',
                'display_name' => 'PRAMU BAKTI',
                'description' => 'PRAMU BAKTI',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'DOKTER-KLINIK-PRATAMA',
                'display_name' => 'DOKTER KLINIK PRATAMA',
                'description' => 'DOKTER KLINIK PRATAMA',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PERAWAT-KLINIK-PRATAMA',
                'display_name' => 'PERAWAT KLINIK PRATAMA',
                'description' => 'PERAWAT KLINIK PRATAMA',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PETUGAS-PASCA-REHABILITASI-NON-PNS',
                'display_name' => 'PETUGAS PASCA REHABILITASI NON PNS',
                'description' => 'PETUGAS PASCA REHABILITASI NON PNS',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'PENGEMUDI',
                'display_name' => 'PENGEMUDI',
                'description' => 'PENGEMUDI',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ];

        foreach ($role as $key => $value) {
            Role::create($value);
        }
    }
}
