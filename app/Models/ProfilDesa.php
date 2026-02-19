<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'nama_desa',
        'alamat_singkat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',

        'deskripsi',

        'email',
        'telp',
        'whatsapp',
        'maps_url',

        'logo',
        'hero',

        'rpjmdes_file',
        'rkpdes_file',

        'aktif',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'aktif' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
