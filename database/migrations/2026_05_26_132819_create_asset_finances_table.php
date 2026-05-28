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
        Schema::create('asset_finances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('asset_id')
                ->constrained('assets')
                ->onDelete('cascade');

            $table->enum('jenis_transaksi', [

                'pembelian',
                'maintenance',
                'perbaikan',
                'pengeluaran_lain'

            ]);

            $table->decimal('nominal', 15, 2);

            $table->date('tanggal_transaksi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_finances');
    }
};
