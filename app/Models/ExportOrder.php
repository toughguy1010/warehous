<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Models\Customer;
class ExportOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_id',
        'order_number',
        'order_status',
        'amount',
        'order_date',
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id'); // Explicitly define the foreign key
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function getStatus()
    {
        return $this->order_status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán';
    }
    public function getDate()
    {
        if($this->order_date !== null){
            return Carbon::parse($this->order_date)->format('d/m/Y');
            
        }
        return "Chưa có ngày tạo đơn";
    }
}
