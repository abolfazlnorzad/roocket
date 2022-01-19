<?php

namespace Nrz\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nrz\Category\Models\Category;
use Nrz\Media\Models\Media;
use Nrz\User\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "user_id",
        "media_id",
        "description",
    ];

    protected $with = ["media"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_post");
    }
}
