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
        Schema::create('tugasakhirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('Cascade');

            $table->string('judul1')->default('-');
            $table->string('judul2')->default('-');
            $table->string('dokumen_proposal1')->default('-');
            $table->string('dokumen_proposal2')->default('-');
            $table->text('cttmhs')->nullable();
            $table->enum('status_usulan', ['0', '1', '2', '3', '4', '5'])->default('0');

            $table->string('pilihjudul')->default('-')->nullable();
            // $table->date('tanggalsidang')->nullable();

            $table->unsignedBigInteger('pembimbing1')->nullable();
            $table->foreign('pembimbing1')->references('id')->on('dosens')->onDelete('Cascade');
            $table->unsignedBigInteger('pembimbing2')->nullable();
            $table->foreign('pembimbing2')->references('id')->on('dosens')->onDelete('Cascade');
            $table->text('reviewta')->nullable();
            $table->string('fullta')->default('-');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugasakhirs');
    }
};
