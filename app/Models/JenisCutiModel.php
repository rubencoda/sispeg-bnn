<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCutiModel extends Model
{
    use HasFactory;

    protected $fillable = ['nama_cuti', 'type_cuti', 'total_hari'];


    public function Cuti()
    {
        return $this->hasMany(Cuti::class);
    }
}
