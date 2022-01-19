<?php

namespace Nrz\Post\Database\Repo;

use Nrz\Post\Models\Comment;

class CommentRepo
{

    protected function getQuery()
    {
        return Comment::query();
    }

    public function storeNewComment($data)
    {
        $data["user_id"] = auth()->id();
        return $this->getQuery()->create($data);
    }

//    protected function generateCommentableType($type)
//    {
//        if ($type == 'post'){
//            return get_class(new Post());
//        }
//
//        throw new \Exception("something goes wrong .");
//    }
}
