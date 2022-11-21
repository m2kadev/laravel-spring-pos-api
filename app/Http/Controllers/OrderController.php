<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Orders::all();
    }

    public function store(Request $request)
    {
        $orderField = $request->validate([
            'customer_id' => 'required',
            'total_amount' => 'required',
            'total_discount' => 'required'
        ]);

        $order = Orders::create($orderField);

        $orderItems = $request->items;

        foreach ($orderItems as $item) {
            OrderItems::create([
                'product_id' => $item['product_id'],
                'order_id' => $order->id,
                'qty' => $item['qty'],
                'price' => $item['price'],
                'sub_total' => $item['sub_total']
            ]);
        }

        return $orderItems;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

   }
}