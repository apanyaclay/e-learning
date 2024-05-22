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
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('nip')->length(10)->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_admin')->length(150);
            $table->string('alamat')->length(150);
            $table->string('no_hp')->length(20);
            $table->enum('jenis_kelamin', ['L','P']);
            $table->string('tempat_lahir')->length(100);
            $table->string('agama')->length(100);
            $table->date('tanggal_lahir');
            $table->string('foto')->nullable();
            $table->text('tentang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
