<?php

namespace Nrz\Category\Database\Seeder;

use Illuminate\Database\Seeder;
use Nrz\Category\Models\Category;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        foreach (Category::$defaultCategories as $category) {
            Category::query()->firstOrCreate(
                ['name' => $category['name']]
                , [
                "name" => $category['name'],
            ]);
        }
    }

}
