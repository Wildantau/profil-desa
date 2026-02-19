<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah field JSON untuk Smart Village
     */
    public function up(): void
    {
        Schema::table('statistik_penduduk', function (Blueprint $table) {

            // ===============================
            // DATA TAMBAHAN SMART VILLAGE
            // Disimpan dalam format JSON
            // ===============================

            $table->json('usia')
                ->nullable()
                ->after('keterangan')
                ->comment('Distribusi penduduk berdasarkan kelompok usia');

            $table->json('pekerjaan')
                ->nullable()
                ->after('usia')
                ->comment('Distribusi penduduk berdasarkan mata pencaharian');

            $table->json('pendidikan')
                ->nullable()
                ->after('pekerjaan')
                ->comment('Distribusi penduduk berdasarkan tingkat pendidikan');

            $table->json('agama')
                ->nullable()
                ->after('pendidikan')
                ->comment('Distribusi penduduk berdasarkan agama');
        });
    }

    /**
     * Rollback kolom Smart Village
     */
    public function down(): void
    {
        Schema::table('statistik_penduduk', function (Blueprint $table) {
            $table->dropColumn([
                'usia',
                'pekerjaan',
                'pendidikan',
                'agama',
            ]);
        });
    }
};
