<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontEndController extends Controller
{
    public function index()
    {
    	$products = Product::paginate(6);
    	return view('index')->withProducts($products);
    }

    public function SingleProduct($id)
    {
    	$product = Product::find($id);
    	return view('single')->withProduct($product);
    }
}
