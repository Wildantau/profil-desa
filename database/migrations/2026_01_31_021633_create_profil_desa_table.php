<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('profil_desa', function (Blueprint $table) {
      $table->id(); // single record: id=1
      $table->string('nama_desa', 120)->default('Desa Surianmedal');
      $table->string('kecamatan', 120)->nullable();
      $table->string('kabupaten', 120)->nullable();
      $table->string('provinsi', 120)->nullable();

      $table->string('alamat', 255)->nullable();
      $table->string('kode_pos', 20)->nullable();
      $table->string('telepon', 40)->nullable();
      $table->string('email', 120)->nullable();
      $table->string('website', 150)->nullable();

      // boleh kosong (professional: tampil “_____” di view)
      $table->string('kepala_desa', 120)->nullable();
      $table->string('sekretaris_desa', 120)->nullable();

      $table->text('visi')->nullable();
      $table->text('misi')->nullable();
      $table->text('sejarah_singkat')->nullable();

      // dusun sesuai studi kasus kamu
      $table->string('dusun_1', 120)->nullable();
      $table->string('dusun_2', 120)->nullable();

      // media path/url
      $table->string('logo', 255)->nullable();
      $table->string('hero_1', 255)->nullable();
      $table->string('hero_2', 255)->nullable();
      $table->string('hero_3', 255)->nullable();

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('profil_desa');
  }
};
