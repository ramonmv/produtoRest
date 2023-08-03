<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\RegisterCategoryRequest;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return CategoryResource::collection(Category::all());
    }


    public function store(RegisterCategoryRequest $request)
    {
        $request->validated();

        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {   
        $category->update($request->validated());
        
        return CategoryResource::make($category);
    }

    public function destroy(Category $category)
    {
        
        $category->delete();

        return response()->json([
            'status' => 'Categoria exclúida!',
        ], 204);
    }

}
