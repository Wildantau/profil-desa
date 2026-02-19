<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    // ⬅️ INI KUNCI UTAMA
    protected $table = 'penduduks';

    protected $fillable = [
        'nik',
        'nama',
        'jk',
        'tgl_lahir',
        'dusun',
        'rt',
        'rw',
        'alamat',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status_kawin',
        'kewarganegaraan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'tgl_lahir' => 'date',
    ];
}
