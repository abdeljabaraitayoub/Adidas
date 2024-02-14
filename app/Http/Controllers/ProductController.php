<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::join('categories', 'categories.id', 'products.category_id')->select('products.*', 'categories.name as category_name')
            ->where('title', 'like', '%' . $request->search . '%')
            ->paginate(5);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
