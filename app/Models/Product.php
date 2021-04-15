<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'is_available',
        'image',
        'category_id',
    ];

    // relationship with the category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
