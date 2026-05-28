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
        Schema::create('asset_attachments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('asset_id')
                ->constrained('assets')
                ->onDelete('cascade');

            $table->string('nama_file');

            $table->string('tipe_file');

            $table->timestamp('upload_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_attachments');
    }
};
