<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pegawai_id', 'check_in', 'check-out', 'keterangan'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'pegawai_id', 'id');
    }
}
