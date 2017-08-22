<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use Stripe\Stripe;
use Stripe\Charge;
use Mail;
use Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function pay()
    {

    	Stripe::setApiKey("sk_test_hZNJvF9QbzRHqDl59RIFBML0");

    	$charge = Charge::create([

    		'amount' => Cart::total() * 100,
    		'currency' => 'usd',
    		'description' => 'Online Shop For Book',
    		'source' => request()->stripeToken

    	]);

    	Session::flash('success', 'Purchased Successfull. Wait for our Email.');

    	Cart::destroy();

    	Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchasedSuccessful);

    	return redirect('/');

    }
}
