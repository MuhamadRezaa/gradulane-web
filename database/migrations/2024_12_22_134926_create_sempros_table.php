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
        Schema::create('sempros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tugasakhir_id');
            $table->foreign('tugasakhir_id')->references('id')->on('tugasakhirs')->onDelete('Cascade');
            $table->date('tgl_sempro')->nullable();
            $table->foreignId('sesi_id')->nullable()->constrained('sesis')->onDelete('set null');
            $table->string('file_sempro')->default('-')->nullable();

            $table->enum('pembimbing1_acc', ['0', '1'])->default('0');
            $table->enum('pembimbing2_acc', ['0', '1'])->default('0');

            $table->unsignedBigInteger('pengujisempro_id')->nullable();
            $table->foreign('pengujisempro_id')->references('id')->on('dosens')->onDelete('set null');
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->onDelete('set null');

            $table->enum('status_sempro', ['0', '1', '2', '3', '4', '5'])->default('0');

            $table->decimal('nilaiakhir', 5, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sempros');
    }
};
