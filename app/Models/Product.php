<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'title', 'slug', 'category_id',
        'content', 'weight', 'price', 'stock', 'discount'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getImageAttribute($image)
    {
        return asset('storage/' . $image);
    }
}
