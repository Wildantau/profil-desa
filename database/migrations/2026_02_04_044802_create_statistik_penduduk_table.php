<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration
     */
    public function up(): void
    {
        Schema::create('statistik_penduduk', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Periode Laporan
            | Satu baris = satu bulan
            |--------------------------------------------------------------------------
            */
            $table->year('tahun')->comment('Tahun laporan statistik');
            $table->unsignedTinyInteger('bulan')->comment('Bulan laporan (1-12)');

            /*
            |--------------------------------------------------------------------------
            | Statistik Inti Penduduk (Agregat, TANPA data personal)
            |--------------------------------------------------------------------------
            */
            $table->unsignedSmallInteger('laki_laki')->default(0)
                ->comment('Jumlah penduduk laki-laki');

            $table->unsignedSmallInteger('perempuan')->default(0)
                ->comment('Jumlah penduduk perempuan');

            $table->unsignedSmallInteger('total')->default(0)
                ->comment('Total penduduk (laki-laki + perempuan)');

            /*
            |--------------------------------------------------------------------------
            | Perubahan Penduduk (Opsional, internal desa)
            |--------------------------------------------------------------------------
            */
            $table->unsignedSmallInteger('lahir')->default(0)
                ->comment('Jumlah kelahiran');

            $table->unsignedSmallInteger('meninggal')->default(0)
                ->comment('Jumlah kematian');

            $table->unsignedSmallInteger('datang')->default(0)
                ->comment('Jumlah penduduk datang');

            $table->unsignedSmallInteger('pindah')->default(0)
                ->comment('Jumlah penduduk pindah');

            /*
            |--------------------------------------------------------------------------
            | Keterangan Tambahan
            |--------------------------------------------------------------------------
            */
            $table->string('keterangan', 255)->nullable()
                ->comment('Catatan tambahan / sumber data');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Constraint & Index
            |--------------------------------------------------------------------------
            */
            $table->unique(['tahun', 'bulan'], 'statistik_periode_unique');
            $table->index(['tahun', 'bulan'], 'statistik_periode_index');
        });
    }

    /**
     * Rollback migration
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_penduduk');
    }
};
