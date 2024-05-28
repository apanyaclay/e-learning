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
        Schema::create('siswas', function (Blueprint $table) {
            $table->integer('nisn')->length(10)->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained()->onDelete('cascade');
            $table->string('nama')->length(150);
            $table->string('alamat')->length(150);
            $table->enum('jenis_kelamin', ['L','P']);
            $table->string('tempat_lahir')->length(100);
            $table->string('agama')->length(100);
            $table->date('tanggal_lahir');
            $table->string('foto')->nullable();
            $table->text('tentang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
