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
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId("nim");
            $table->string("kategori_pekerjaan1");
            $table->string("kategori_pekerjaan2");
            $table->string("kategori_pekerjaan3");
            $table->string("nama_pekerjaan");
            $table->string("tempat_pekerjaan")->nullable();
            $table->date("tanggal_pekerjaan");
            $table->integer("gaji");
            $table->string("relevansi_pekerjaan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaans');
    }
};
