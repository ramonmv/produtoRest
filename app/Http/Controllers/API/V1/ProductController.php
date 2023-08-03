<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\RegisterProductRequest;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(RegisterProductRequest $request)
    {
        $request->validated();

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'value' => $request->value,
            'categories_id' => $request->categories_id,
        ]);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {   
        return ProductResource::make($product);
        // return ProductResource::make($product)->additional(['status' => 'achado'])->response()->setStatusCode(202);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {   
        $product->update($request->validated());
        
        return ProductResource::make($product);
    }

    public function destroy(Product $product)
    {
        
        $product->delete();

        return response()->json([
            'message' => 'Produto exclúido!',
        ], 204);
    }


}
