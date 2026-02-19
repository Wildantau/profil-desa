<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();

            // Nama destinasi wisata
            $table->string('nama');

            // Deskripsi singkat wisata
            $table->text('deskripsi')->nullable();

            // Lokasi / alamat wisata
            $table->string('lokasi')->nullable();

            // Status publikasi
            $table->enum('status', ['draft', 'publik'])
                  ->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};
