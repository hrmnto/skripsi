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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id("nim");
            $table->string("kontak");
            $table->string("foto")->nullable();
            $table->string("name");
            $table->foreignId("user_id");
            $table->date("tglMasuk");
            $table->date("tglLulus");
            $table->string("ipk");
            $table->string("tempatLahir");
            $table->string("kelurahan");
            $table->string("kecamatan");
            $table->string("kabupaten");
            $table->string("provinsi");
            $table->date("tglLahir");
            $table->string("jk");
            $table->string("agama");
            $table->string("kawin");
            $table->string("pekerjaan");
            $table->string("noIjazah");
            $table->string("fotoIjazah")->nullable();
            $table->string("koordinat");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
