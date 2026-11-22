<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function user() { return $this->belongsTo(User::class); }
    public function store() { return $this->belongsTo(Store::class); }
    public function courier() { return $this->belongsTo(User::class, 'courier_id'); }
    public function splits() { return $this->hasMany(OrderSplit::class); }
}