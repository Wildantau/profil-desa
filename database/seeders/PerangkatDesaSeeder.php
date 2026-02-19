<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerangkatDesaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('perangkat_desa')->insert([
            // ======================
            // KEPALA DESA
            // ======================
            [
                'jabatan' => 'Kepala Desa',
                'nama' => 'LILI SARIPUDIN',
                'kategori' => 'kepala_desa',
                'foto' => 'images/pemerintahan/kepala-desa.png',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================
            // SEKRETARIS DESA
            // ======================
            [
                'jabatan' => 'Sekretaris Desa',
                'nama' => 'DIDI DAYAK',
                'kategori' => 'sekretaris',
                'foto' => 'images/pemerintahan/sekretaris-desa.png',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================
            // KASI
            // ======================
            [
                'jabatan' => 'Kasi Pemerintahan',
                'nama' => 'FERI NURZAMAN',
                'kategori' => 'kasi',
                'foto' => 'images/pemerintahan/kasi-pemerintahan.png',
                'urutan' => 3,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Kasi Kesejahteraan',
                'nama' => 'TRISNO DEBY PURNOMO',
                'kategori' => 'kasi',
                'foto' => 'images/pemerintahan/kasi-kesejahteraan.png',
                'urutan' => 4,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Kasi Pelayanan',
                'nama' => null,
                'kategori' => 'kasi',
                'foto' => null,
                'urutan' => 5,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================
            // KAUR
            // ======================
            [
                'jabatan' => 'Kaur TU & Umum',
                'nama' => 'SURYANI',
                'kategori' => 'kaur',
                'foto' => 'images/pemerintahan/kaur-tu-umum.png',
                'urutan' => 6,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Kaur Keuangan',
                'nama' => 'WARID SAEPUDIN',
                'kategori' => 'kaur',
                'foto' => 'images/pemerintahan/kaur-keuangan.png',
                'urutan' => 7,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Kaur Perencanaan',
                'nama' => 'SUTISNA',
                'kategori' => 'kaur',
                'foto' => 'images/pemerintahan/kaur-perencanaan.png',
                'urutan' => 8,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ======================
            // KEPALA DUSUN
            // ======================
            [
                'jabatan' => 'Kepala Dusun I',
                'nama' => 'IWAN SUTARDI',
                'kategori' => 'dusun',
                'foto' => 'images/pemerintahan/kepala-dusun-1.png',
                'urutan' => 9,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Kepala Dusun II',
                'nama' => 'WILDA WINENGSIH',
                'kategori' => 'dusun',
                'foto' => 'images/pemerintahan/kepala-dusun-2.png',
                'urutan' => 10,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
