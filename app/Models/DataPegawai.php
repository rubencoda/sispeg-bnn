<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;

class DataPegawai extends Model
{
    use HasFactory, LaravelEntrustUserTrait;

    protected $fillable = [
        'user_id',
        'pas_foto',
        'nama_lengkap',
        'no_hp',
        'email',
        'nip',
        'role_id',
        'pangkat_gol',
        'alamat_rumah',
        'ttl',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'pendidikan_terakhir',
        'nik',
        'ktp',
        'npwp',
        'sim_a',
        'sim_b',
        'sim_c',
        'paspor',
        'created_at',
        'updated_at',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Role()
    {
        return $this->belongsTo(Role::class);
    }

    public function Presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}
