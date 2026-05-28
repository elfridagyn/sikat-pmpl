<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetFinance extends Model
{
    protected $fillable = [

        'asset_id',
        'jenis_transaksi',
        'nominal',
        'tanggal_transaksi'

    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

}
