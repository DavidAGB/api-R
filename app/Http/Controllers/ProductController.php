<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();
        return $product;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;

        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
    }


    public function show(Product $product)
    {
        $product = Product::find($product->id);
        return $product;
    }


    


    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($request->id);
        $product->name = $request->name;

        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();
        return $product;
    }


    public function destroy(Product $product)
    {
        $product = Product::destroy($product->id);
        return $product;
    }
}
