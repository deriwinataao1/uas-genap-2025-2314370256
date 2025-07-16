<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'is_publish',
        'published_at',
        'image_url',
        'rating',
        'reviews',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected $casts = [
        'published_at' => 'datetime',
    ];
    public function images()
{
    return $this->hasMany(ProductImage::class);
}

    
}
