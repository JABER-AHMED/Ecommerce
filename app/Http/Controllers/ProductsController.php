<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use Session;

class ProductsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$products = Product::all();
    	return view('products.index')->withProducts($products);
    }

    public function create()
    {
    	return view('products.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, array(

    		'name' => 'required',
    		'image' => 'required|image',
    		'price' => 'required',
    		'description' => 'required'

       ));

    	$product = new Product;

    	$image = $request->image;

    	$filename = time() . $image->getClientOriginalName();

    	$image->move('uploads/images', $filename);

    	$product->name = $request->name;
    	$product->price = $request->price;
    	$product->description = $request->description;
    	$product->image = 'uploads/images/'.$filename;

    	$product->save();

    	Session::flash('success', 'Products created successfully');
    	return redirect()->route('product.index');
    }

    public function edit($id)
    {
    	$product = Product::find($id);
    	return view('products.edit')->withProduct($product);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, array(

    		'name' => 'required',
    		'price' => 'required',
    		'description' => 'required'

       ));

    	$product = Product::find($id);

    	if ($request->hasFile('image')) {
    		
    		$image = $request->image;

    		$filename = time() . $image->getClientOriginalName();

    		$image->move('uploads/images', $filename);
    		$product->image = 'uploads/images/'.$filename;

    		$product->save();
    	}

    	$product->name = $request->name;
    	$product->price = $request->price;
    	$product->description = $request->description;
    	
    	$product->save();

    	Session::flash('success', 'Products updated successfully');

    	return redirect()->route('product.index');
    }

    public function delete($id)
    {
    	$product = Product::find($id);

    	if (file_exists($product->image)) {
    		
    		unlink($product->image);
    	}

    	$product->delete();

    	Session::flash('success', 'products deleted successfully');

    	return redirect()->back();
    }
}
