<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index()
    {
        return view('add_product');
    }
    public function add_product(Request $request)
    {
       // return respose()->json($request->all());
        // print_r($request->all());
        // exit();
        $product = new Product();
        $product->title = $request->title;
        $product->category = $request->category;
        $product->sku = $request->sku;
        $product->upc = $request->upc;
        $product->condition = $request->condition;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->shipping_cost = $request->shipping_cost;
        $product->description = $request->description;
        $product->save();
        $product_id = $product->id;
        if($request->hasFile('file'))
        {
            $files = $request->file('file');
            foreach($files as $file)
            {
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
                $product_image = new ProductImage();
                $product_image->product_id = $product_id;
                $product_image->path = $name;
                $product_image->save();
            }
    }
    return response()->json(['success'=>'Product added successfully.']);
    }
    
}
