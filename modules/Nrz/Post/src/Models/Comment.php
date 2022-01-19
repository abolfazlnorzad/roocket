<?php

namespace Nrz\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "message",
        "commentable_type",
        "commentable_id",
        "parent_id",
    ];

    public function child()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
