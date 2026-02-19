<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ============================================================
 * MODEL : StatistikPenduduk
 * ------------------------------------------------------------
 * Statistik penduduk BULANAN (tanpa data individu)
 * Support:
 * - SQLite (JSON disimpan sebagai TEXT)
 * - MySQL / MariaDB
 * - Chart.js (semua angka dipaksa integer)
 * ============================================================
 */

class StatistikPenduduk extends Model
{
    use HasFactory;

    protected $table = 'statistik_penduduk';

    /**
     * Kolom yang boleh diisi (Mass Assignment)
     */
    protected $fillable = [
        'tahun',
        'bulan',

        'total',
        'laki_laki',
        'perempuan',

        'lahir',
        'meninggal',
        'datang',
        'pindah',

        'keterangan',

        // JSON SMART VILLAGE
        'usia',
        'pekerjaan',
        'pendidikan',
        'agama',
    ];

    /**
     * Casting dasar (NON JSON)
     */
    protected $casts = [
        'tahun'      => 'integer',
        'bulan'      => 'integer',

        'total'      => 'integer',
        'laki_laki'  => 'integer',
        'perempuan'  => 'integer',

        'lahir'      => 'integer',
        'meninggal'  => 'integer',
        'datang'     => 'integer',
        'pindah'     => 'integer',
    ];

    /* =========================================================
     | 🔥 MUTATOR JSON (SIMPAN OTOMATIS JADI JSON STRING)
     | ========================================================= */

    public function setUsiaAttribute($value)
    {
        $this->attributes['usia'] = $this->encodeJson($value);
    }

    public function setPekerjaanAttribute($value)
    {
        $this->attributes['pekerjaan'] = $this->encodeJson($value);
    }

    public function setPendidikanAttribute($value)
    {
        $this->attributes['pendidikan'] = $this->encodeJson($value);
    }

    public function setAgamaAttribute($value)
    {
        $this->attributes['agama'] = $this->encodeJson($value);
    }

    /* =========================================================
     | 🔥 ACCESSOR JSON (ANTI SQLITE + PAKSA INTEGER)
     | ========================================================= */

    public function getUsiaAttribute($value): array
    {
        return $this->decodeJsonToIntArray($value);
    }

    public function getPekerjaanAttribute($value): array
    {
        return $this->decodeJsonToIntArray($value);
    }

    public function getPendidikanAttribute($value): array
    {
        return $this->decodeJsonToIntArray($value);
    }

    public function getAgamaAttribute($value): array
    {
        return $this->decodeJsonToIntArray($value);
    }

    /**
     * Encode array → JSON
     */
    private function encodeJson($value): ?string
    {
        if (is_array($value)) {
            return json_encode($value);
        }

        return null;
    }

    /**
     * Decode JSON → Array Integer
     */
    private function decodeJsonToIntArray($value): array
    {
        if (is_array($value)) {
            return collect($value)
                ->map(fn ($v) => (int) $v)
                ->toArray();
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (is_array($decoded)) {
                return collect($decoded)
                    ->map(fn ($v) => (int) $v)
                    ->toArray();
            }
        }

        return [];
    }

    /* =========================================================
     | SCOPE — DATA TERBARU
     | ========================================================= */
    public function scopeLatestPeriod($query)
    {
        return $query
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc');
    }

    /* =========================================================
     | ACCESSOR — NAMA BULAN
     | ========================================================= */
    public function getNamaBulanAttribute(): string
    {
        return [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ][$this->bulan] ?? '-';
    }
}
