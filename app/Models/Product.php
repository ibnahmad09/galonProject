<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];

    public function orders()
    {
        return $this->hasManyThrough(OrderDetail::class, Order::class);
    }

    public function stockMutations()
    {
        return $this->hasMany(StockMutation::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
