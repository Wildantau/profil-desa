<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id();

            // kategori utama untuk grouping tampilan
            // kepala_desa | sekretaris | kasi | kaur | dusun
            $table->string('kategori', 30)->index();

            // contoh: Kepala Desa, Sekretaris Desa, Kasi Pemerintahan
            $table->string('jabatan', 120);

            // boleh kosong kalau belum ditetapkan
            $table->string('nama', 120)->nullable();

            // path relatif gambar: images/pemerintahan/xxx.png
            $table->string('foto', 255)->nullable();

            // untuk sorting tampilan
            $table->unsignedInteger('urutan')->default(0)->index();

            // tampil / tidak
            $table->boolean('aktif')->default(true)->index();

            $table->timestamps();

            // Index gabungan untuk query yang sering dipakai:
            // where aktif=1 orderBy kategori, urutan
            $table->index(['aktif', 'kategori', 'urutan'], 'perangkat_desa_fast_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
