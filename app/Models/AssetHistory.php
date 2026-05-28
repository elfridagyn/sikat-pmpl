<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetHistory extends Model
{
    use HasFactory;

    protected $table = 'asset_histories';

    protected $fillable = [
        'asset_id',
        'user_id',
        'aktivitas',
        'keterangan',
        'tanggal'
    ];

    /**
     * Otomatis mengubah string database menjadi Objek Carbon / Date
     */
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
