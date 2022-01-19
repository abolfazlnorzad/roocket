<?php

namespace Nrz\Category\Database\Repo;

use Nrz\Category\Models\Category;

class CategoryRepo
{
    protected function getQuery()
    {
        return Category::query();
    }

    // list of All Category
    public function getAllCategoryWithPagination()
    {
        return $this->getQuery()->latest()->paginate(25);
    }

    //store new Category
    public function storeCategory($data)
    {
        return $this->getQuery()->create($data);
    }

    // update a category
    public function updateCategory(Category $category, $data)
    {
        return $category->update($data);
    }

    //delete a category
    public function deleteCategory(Category $category)
    {
        return $category->delete();
    }
}
