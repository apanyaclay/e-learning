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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->longText('detail')->nullable();
            $table->timestamp('tenggat');
            $table->foreignId('pertemuan_id')->constrained()->onDelete('cascade');
            $table->integer('guru_nuptk')->length(10);
            $table->foreign('guru_nuptk')->references('nuptk')->on('gurus')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
