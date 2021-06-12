<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'products_id'
    ];

    public function productGallery()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function getImageAttribute($image)
    {
        return asset('storage/' . $image);
    }
}
