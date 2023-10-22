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
        Schema::create('apars', function (Blueprint $table) {
            $table->id();
            $table->string("lokasi")->nullable();
            $table->string("kondisi")->nullable();
            $table->tinyInteger("segitiga_apar")->nullable()->default(0);
            $table->tinyInteger("kartu_pemeliharaan")->nullable()->default(0);
            $table->tinyInteger("petunjuk_penggunaan")->nullable()->default(0);
            $table->string("jenis", 50)->nullable();
            $table->string("ukuran", 10)->nullable();
            $table->date("tanggal_kadaluarsa")->nullable();
            $table->string("keterangan")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apars');
    }
};
