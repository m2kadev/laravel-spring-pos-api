<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'quantity' => 'required',
            'discount' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product_images', 'public');
        }

        return Product::create($formFields);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
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
        $formFields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'quantity' => 'required',
            'discount' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product_images', 'public');
        }

        $product = Product::find($id);

        $product->update($formFields);

        return $product;
    }

    /* reduce quantity when ordered */
    public function reduceQty (Request $request){

        $orders = $request->all();

        foreach ($orders as $order) {
            $product = Product::where('id', $order['product_id']);
            $product->decrement('stock', $order['qty']);
        }

        return $orders;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($category)
    {
        return Product::where('category', 'like', '%' . $category . '%')->get();
    }

}
