<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'stall_id', 'category_id', 'name', 'slug', 'description', 'price', 'image', 'stock', 'is_available', 'is_popular',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_popular' => 'boolean',
    ];

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
