<?php

namespace Nrz\Category\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use Nrz\Category\Database\Repo\CategoryRepo;
use Nrz\Category\Http\Requests\CategoryRequest;
use Nrz\Category\Http\Resources\CategoryResource;
use Nrz\Category\Models\Category;


class CategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store','update','destroy']);
        $this->middleware('is.admin')->only(['store','update','destroy']);
    }



    public function index(CategoryRepo $categoryRepo)
    {
        $categories = $categoryRepo->getAllCategoryWithPagination();
        $categoriesCollection = CategoryResource::collection($categories);
        return $this->successResponse([
            'categories' => $categoriesCollection,
            'links' => $categoriesCollection->response()->getData()->links,
            'meta' => $categoriesCollection->response()->getData()->meta
        ], 200, "success");
    }


    public function store(CategoryRequest $request, CategoryRepo $categoryRepo)
    {
        $newCategory = $categoryRepo->storeCategory($request->all());
        return $this->successResponse(new CategoryResource($newCategory->loadCount("posts")), 200, "category has been created");
    }


    public function show(Category $category)
    {
        return $this->successResponse(new CategoryResource($category), 200, "success");
    }


    public function update(CategoryRequest $request, Category $category,CategoryRepo $categoryRepo)
    {
        $categoryRepo->updateCategory($category,$request->all());
        return $this->successResponse(new CategoryResource($category), 200, "The update was successful ");
    }


    public function destroy(Category $category , CategoryRepo $categoryRepo)
    {
        $categoryRepo->deleteCategory($category);
        return $this->successResponse(new CategoryResource($category), 200, "The category was deleted ! ");

    }
}
