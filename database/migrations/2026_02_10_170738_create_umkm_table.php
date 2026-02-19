<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();

            $table->string('nama_usaha');
            $table->string('pelaku');
            $table->string('kategori')->nullable();
            $table->text('deskripsi')->nullable();

            $table->string('foto')->nullable();

            // status konsisten dengan Wisata
            $table->string('status')->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
