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
        Schema::create('bimbingans', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('tugasakhir_id');
            $table->foreign('tugasakhir_id')->references('id')->on('tugasakhirs')->onDelete('Cascade');

            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('Cascade');

            $table->unsignedBigInteger('pembimbing_id');
            $table->foreign('pembimbing_id')->references('id')->on('dosens')->onDelete('Cascade');

            $table->text('pembahasan');

            $table->date('tglbimbingan');

            $table->enum('verifikasibimbingan', ['0', '1'])->default('0');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};
