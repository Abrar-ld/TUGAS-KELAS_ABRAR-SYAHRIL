<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'nama_pasien',
        'tanggal_lahir',
        'no_rekam_medis',
        'domisili',
        'kontak_darurat',
    ];
}