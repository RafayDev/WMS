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
    public function list_product()
    {
        $products = Product::paginate(15);
        return view('list_products', compact('products'));
    }
    public function delete_product(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $product->delete();
        return redirect()->back()->with('error', 'Product deleted successfully.');
    }
    public function edit_product($id)
    {
        $product_id = $id;
        $product = Product::find($product_id);
        return view('update_product', compact('product'));
    }
    public function update_product(Request $request, $id)
    {
        // print_r($request->all());
        // exit();
        //delete images
        $delete_images = $request->delete_images;
        if($delete_images)
        {
            foreach($delete_images as $delete_image)
            {
                $product_image = ProductImage::find($delete_image);
                $product_image->delete();
            }
        }
        //update images
        if($request->hasFile('file'))
        {
            $files = $request->file('file');
            foreach($files as $file)
            {
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
                $product_image = new ProductImage();
                $product_image->product_id = $id;
                $product_image->path = $name;
                $product_image->save();
            }
        }
        $product_id = $id;
        $product = Product::find($product_id);
        $product->title = $request->title;
        $product->category = $request->category;
        $product->sku = $request->sku;
        $product->upc = $request->upc;
        $product->condition = $request->condition;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->shipping_cost = $request->shipping_cost;
        $product->description = $request->content;
        $product->save();
        return redirect()->back()->with('success', 'Product updated successfully.<br> <a href="/list-products">Go to Inventory</a>');
    }
}
