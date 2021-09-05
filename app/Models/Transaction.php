<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'customer_name',
        'quantity',
        'price'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
