<?php

namespace Nrz\Post\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use Nrz\Post\Database\Repo\LikeRepo;
use Nrz\Post\Http\Requests\V1\LikeRequest;

class LikeController extends ApiController
{

    public function checkUserLikedPost(LikeRequest $request, LikeRepo $likeRepo)
    {
        return $likeRepo->checkUserLikedPost($request->post_id);
    }

}
