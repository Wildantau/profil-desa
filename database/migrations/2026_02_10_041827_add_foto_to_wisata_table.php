<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisata', function (Blueprint $table) {

            if (!Schema::hasColumn('wisata', 'foto')) {
                $table->string('foto')->nullable();
            }

            if (!Schema::hasColumn('wisata', 'status')) {
                $table->string('status')->default('draft');
            }

        });
    }

    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {

            if (Schema::hasColumn('wisata', 'foto')) {
                $table->dropColumn('foto');
            }

            if (Schema::hasColumn('wisata', 'status')) {
                $table->dropColumn('status');
            }

        });
    }
};
