<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'status',
        'room_id',
        'owner_id',
    ];


    // Define the relationship with the user
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Define the relationship with room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Define the relationship with products
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity']);
    }
}
