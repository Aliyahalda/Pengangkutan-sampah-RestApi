<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sampah extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'kepala_keluarga',
        'no_rumah',
        'rt_rw',
        'total_karung_sampah',
        'kriteria',
        'tanggal_pengangkutan',
    ];
}
