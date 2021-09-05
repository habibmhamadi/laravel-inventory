<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier_id',
        'measurement_id',
        'price',
        'quantity'
    ];

    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
