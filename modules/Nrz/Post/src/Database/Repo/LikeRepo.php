<?php

namespace Nrz\Post\Database\Repo;

use App\Traits\ApiResponser;
use Nrz\Post\Models\PostLike;

class LikeRepo
{
    use ApiResponser;

    protected function getQuery()
    {
        return PostLike::query();
    }

    public function likePost($postId)
    {
        $this->getQuery()->create([
            "user_id" => auth()->id(),
            "post_id" => $postId
        ]);
        return $this->successResponse(null, 200, "like");
    }

    public function dislikePost(PostLike $like)
    {
        $like->delete();
        return $this->successResponse(null, 200, "dislike");
    }


    public function checkUserLikedPost($postId)
    {
        $postLike = auth()->user()->likes->where("post_id", $postId)->first();
        if ($postLike) {
            return $this->dislikePost($postLike);
        } else {
            return $this->likePost($postId);
        }
    }

}
