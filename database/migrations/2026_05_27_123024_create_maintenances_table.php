<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            // Menghubungkan log perbaikan ke id spesifik di tabel assets
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->date('tanggal_perbaikan');
            $table->string('jenis_perbaikan'); // Contoh penampung data: 'Routine' atau 'Repair'
            $table->string('nama_teknisi');    // Contoh penampung data: 'Budi Setiawan'
            $table->string('status');          // Contoh penampung data: 'Completed' atau 'In Progress'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};