<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImportOrder;
use App\Models\Products;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'order_type',
        'product_id',
        'quantity',
        'single_price',
        'total_price',
    ];
    public function importOrder()
    {
        return $this->belongsTo(ImportOrder::class, 'order_id'); // Explicitly define the foreign key
    }
    public function product(){
        return $this->belongsTo(Products::class, 'product_id'); // Explicitly define the foreign key

    }
}
