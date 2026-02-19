<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    protected $table = 'perangkat_desa';

    /**
     * Jika migration kamu menggunakan timestamps() (created_at, updated_at),
     * biarkan default (true).
     * Jika tidak pakai timestamps, ubah jadi false:
     * public $timestamps = false;
     */

    /**
     * Field yang boleh diisi (aman untuk CRUD admin)
     */
    protected $fillable = [
        'kategori',   // kepala_desa | sekretaris | kasi | kaur | dusun
        'jabatan',
        'nama',
        'foto',       // path relatif: images/pemerintahan/xxx.png
        'urutan',     // untuk sorting tampilan
        'aktif',      // true / false
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'aktif'  => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Scope helper (opsional tapi rapi)
     * Ambil hanya data aktif & urut
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }
}
