<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'user_id', 'store_id', 'courier_id', 'document_name', 'total_pages',
        'paper_size', 'is_binding', 'binding_color', 'is_express', 'notes',
        'print_price', 'binding_price', 'express_price', 'shipping_price', 'total_price',
        'delivery_type', 'payment_method', 'is_splitbill', 'splitbill_status', 'status'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function courier() { return $this->belongsTo(User::class, 'courier_id'); }
    public function store() { return $this->belongsTo(Store::class); }
}