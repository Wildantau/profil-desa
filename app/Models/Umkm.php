<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Umkm extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'umkm';

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'nama_usaha',
        'pelaku',
        'kategori',
        'deskripsi',
        'status',
        'foto',
    ];

    /**
     * Cast kolom
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
     * Scope: hanya UMKM dengan status publik
     */
    public function scopePublik($query)
    {
        return $query->where('status', self::STATUS_PUBLIK);
    }

    /**
     * Accessor: URL foto aman
     * - Jika file ada di storage/public → tampilkan
     * - Jika tidak ada → fallback ke gambar default
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        return asset('images/umkm/default.jpg');
    }
}
