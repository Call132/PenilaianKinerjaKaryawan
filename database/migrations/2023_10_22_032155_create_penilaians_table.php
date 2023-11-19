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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->string('tujuan');
            $table->date('tanggal_penilaian');
            $table->date('periode_penilaian');
            $table->timestamps();
            $table->integer('skor')->nullable();
            $table->string('komentar')->nullable();
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
