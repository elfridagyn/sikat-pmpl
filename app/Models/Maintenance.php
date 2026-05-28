<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';

    protected $fillable = [
        'asset_id',
        'tanggal_perbaikan',
        'jenis_perbaikan',
        'nama_teknisi',
        'status'
    ];

    /**
     * Casts parameter data untuk otomatisasi parsing objek Carbon
     */
    protected $casts = [
        'tanggal_perbaikan' => 'date',
    ];

    /**
     * Relasi balik ke model induk Asset
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}