<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKBCuti extends Model
{
    use HasFactory;

    protected $fillable = ['nama_skb', 'tgl_skb'];
}
