<?php

namespace Nrz\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\Post\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $withCount =["posts"];
    protected $fillable = ['name']; // or  protected $guarded = [];
    public static $defaultCategories = [
        [
            'name' => 'laravel',
        ],
        [
            'name' => 'vue',
        ],
        [
            'name' => 'react',
        ],
        [
            'name' => 'nodejs',
        ],
        [
            'name' => 'AI',
        ],
        [
            'name' => 'ML',
        ],
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
