<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shanmuga\LaravelEntrust\Models\EntrustRole;

class Role extends EntrustRole
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'created_at',
        'updated_at'
    ];

    public function DataPegawai()
    {
        return $this->hasMany(DataPegawai::class);
    }
}
