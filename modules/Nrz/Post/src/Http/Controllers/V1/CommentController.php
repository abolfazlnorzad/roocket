<?php

namespace Nrz\Post\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use Nrz\Post\Database\Repo\CommentRepo;
use Nrz\Post\Http\Requests\V1\CommentRequest;

class CommentController extends ApiController
{

    public function storeComment(CommentRequest $request, CommentRepo $commentRepo)
    {
        $commentRepo->storeNewComment($request->all());
        return $this->successResponse(null, 200, "the comment has been saved !");
    }

}
