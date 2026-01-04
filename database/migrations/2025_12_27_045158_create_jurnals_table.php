<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();

            // relasi user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // data jurnal
            $table->date('tanggal_kbm');
            $table->string('kelas');

            $table->unsignedInteger('hadir')->default(0);
            $table->unsignedInteger('izin')->default(0);
            $table->unsignedInteger('sakit')->default(0);
            $table->unsignedInteger('alfa')->default(0);

            $table->string('guru');
            $table->string('mata_pelajaran');
            $table->string('materi');
            $table->text('kegiatan')->nullable();

            // waktu
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            // foto
            $table->string('dokumentasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
