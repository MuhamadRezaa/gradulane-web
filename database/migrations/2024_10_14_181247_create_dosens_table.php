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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('namadosen');
            $table->string('nidn')->unique();
            $table->string('nip')->unique();
            $table->string('tmpt_tgl_lahir');
            $table->date('tgl_lahir');
            $table->string('jeniskelamin');
            $table->string('email')->unique();
            $table->string('no_hp')->unique();
            $table->text('alamat');
            $table->unsignedBigInteger('jurusan_id');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')->references('id_prodi')->on('prodis')->onDelete('cascade');
            $table->unsignedBigInteger('jabatan_id');
            $table->foreign('jabatan_id')->references('id_jabatan')->on('jabatans')->onDelete('cascade');
            $table->unsignedBigInteger('jabatanfungsional_id');
            $table->foreign('jabatanfungsional_id')->references('id')->on('jabatanfungsionals')->onDelete('cascade');
            $table->string('link_sinta')->nullable();
            $table->string('foto')->default('-')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
