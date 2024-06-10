<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class Products extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        "name",
        "description",
        "purchase_price",
        "selling_price",
        "supplier_id",
        "unit_id",
        "stock",
        "avatar",
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($product) {
            // Update the product_id of associated order items to null
            OrderItem::where('product_id', $product->id)->update(['product_id' => null]);
        });
    }
}
