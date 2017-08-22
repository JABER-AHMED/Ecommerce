<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use Session;

class ShoppingController extends Controller
{
    public function add_cart()
    {

    	$pdt = Product::find(request()->pdt_id);

    	$cartItem = Cart::add([

    		'id' => $pdt->id,
    		'name' => $pdt->name,
    		'qty' => request()->qty,
    		'price' => $pdt->price
    	]);

        Cart::associate($cartItem->rowId, 'App\Product');

         Session::flash('success', 'Product added to cart.');

    	return redirect()->route('cart');
    }

    public function cart()
    {
        return view('cart');
    }

    public function delete($id)
    {
        Cart::remove($id);

        return redirect()->back();
    }

    public function incr($id, $qty)
    {
        Cart::update($id, $qty + 1);

        return redirect()->back();
    }

    public function decr($id, $qty)
    {
        Cart::update($id, $qty - 1);

        return redirect()->back();
    }

    public function repid_add_cart($id)
    {
        $pdt = Product::find($id);

        $cartItem = Cart::add([

            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => 1,
            'price' => $pdt->price
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');

        Session::flash('success', 'Product added to cart.');

        return redirect()->route('cart');
    }


}
