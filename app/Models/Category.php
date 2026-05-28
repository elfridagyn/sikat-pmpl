<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function assets()
    {
        return $this->hasMany(
            Asset::class,
            'kategori_id'
        );
    }
    protected $fillable = [

        'nama_kategori',
        'subkategori'

    ];
    public function subCategories()
    {
        return $this->hasMany(\App\Models\SubCategory::class, 'category_id');
    }
}
