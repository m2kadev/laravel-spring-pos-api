<?php

namespace App\Models;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $fillable = ['product_id', 'order_id', 'qty', 'price', 'sub_total'];


    public function order () {
        return $this->belongsTo(Orders::class);
    }


}