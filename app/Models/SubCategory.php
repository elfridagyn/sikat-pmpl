<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    // Tambahkan baris di bawah ini:
    protected $fillable = [
        'category_id', 
        'nama_subkategori', 
        'kode_subkategori'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}