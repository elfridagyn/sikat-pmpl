<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetAttachment extends Model
{
    protected $fillable = [

        'asset_id',
        'nama_file',
        'tipe_file',
        'upload_date'

    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
