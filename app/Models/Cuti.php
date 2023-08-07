<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'nama_pegawai', 'jabatan', 'jenis_cuti', 'mulai_cuti', 'akhir_cuti', 'catatan_cuti', 'alamat_cuti', 'status_cuti'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function JenisCuti()
    {
        return $this->belongsTo(JenisCutiModel::class, 'jenis_cuti');
    }
}
