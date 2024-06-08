<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class ImportOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'supplier_id',
        'order_number',
        'order_status',
        'amount',
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id'); // Explicitly define the foreign key
    }
}
