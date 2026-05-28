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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            
            // Seksi: Umum
            $table->string('nama_aset');
            $table->string('kode_aset')->nullable();
            $table->foreignId('kategori_id')
                ->constrained('categories')
                ->onDelete('cascade');

            // Seksi: Detil Aset
            $table->string('merk');
            $table->string('tipe')->nullable();
            $table->string('produsen')->nullable();
            $table->string('no_seri')->nullable();
            $table->integer('tahun_produksi')->nullable();
            $table->text('deskripsi')->nullable();

            // Seksi: Pembelian & Lokasi
            $table->string('lokasi');
            $table->date('tanggal_pembelian');
            $table->string('distributor');
            $table->string('no_invoice')->nullable();
            $table->integer('jumlah')->default(0);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('harga_total', 15, 2)->default(0);

            // Seksi: Tambahan, Kondisi, Penyusutan & Media
            $table->string('kondisi');
            $table->text('keterangan_tambahan')->nullable();
            $table->integer('umur_ekonomi')->default(1); // dalam satuan Tahun
            $table->decimal('penyusutan', 15, 2)->default(0); // per Bulan
            $table->string('foto_aset')->nullable();
            
            // Status & QR
            $table->enum('status', [
                'aktif',
                'non-aktif'
            ])->default('aktif');
            $table->string('qr_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};