<?php

namespace App\Models;

use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = ['customer_id', 'total_amount', 'total_discount'];

    public function orderItems () {
        return $this->hasMany(OrderItems::class);
    }

}