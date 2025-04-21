<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // ✅ Product model import
use App\Http\Resources\ProductResource; // ✅ Resource import
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::get(); // ✅ Correct model class name
        // return $products->count();
        if ($products->count() > 0) {
            return ProductResource::collection($products);
        } else {
            return response()->json(['message' => 'No records available'], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|integer'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $product =  Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,

        ]);

        return response()->json([
            'message' => 'producted created successfully',
            'data' => new  ProductResource($product)
        ], 200);
    }

    public function show(Product $product)
    {
        return new  ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|integer'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ], 422);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,

        ]);

        return response()->json([
            'message' => 'producted updated successfully',
            'data' => new  ProductResource($product)
        ], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'producted deleted successfully',
        ], 200);
    }
}
