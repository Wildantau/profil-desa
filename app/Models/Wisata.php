<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Wisata extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'wisata';

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'lokasi',
        'status',
        'foto',
    ];

    /**
     * Casting kolom
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Konstanta status
     */
    public const STATUS_PUBLIK = 'publik';
    public const STATUS_DRAFT  = 'draft';

    /**
     * Scope: hanya data publik
     */
    public function scopePublik($query)
    {
        return $query->where('status', self::STATUS_PUBLIK);
    }

    /**
     * Helper: cek apakah data publik
     */
    public function isPublik(): bool
    {
        return $this->status === self::STATUS_PUBLIK;
    }

    /**
     * Accessor: URL foto (AMAN & KONSISTEN)
     *
     * - Foto upload admin -> storage/app/public/wisata/*
     * - URL publik        -> /storage/wisata/*
     * - Fallback default  -> public/images/wisata/default.jpg
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        return asset('images/wisata/default.jpg');
    }
}
