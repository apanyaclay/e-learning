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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->integer('siswa_nisn')->length(10);
            $table->foreign('siswa_nisn')->references('nisn')->on('siswas')->onDelete('cascade');
            $table->foreignId('pertemuan_id')->constrained();
            $table->enum('status', ['Hadir', 'izin', 'Alpa', 'Sakit']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
