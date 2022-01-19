<?php

namespace Nrz\Post\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use Nrz\Post\Database\Repo\PostRepo;
use Nrz\Post\Http\Requests\V1\PostRequest;
use Nrz\Post\Http\Resources\V1\PostResource;
use Nrz\Post\Models\Post;

class PostController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
        $this->middleware('is.admin')->only(['store', 'update', 'destroy']);
    }

    public function index(PostRepo $postRepo)
    {
        $postCollections = PostResource::collection($postRepo->getPostWithPaginate(["user", "categories"]));
        return $this->successResponse([
            "posts" => $postCollections,
            "links" => $postCollections->response()->getData()->links,
            "meta" => $postCollections->response()->getData()->meta,
        ], 200, null);
    }


    public function store(PostRequest $request, PostRepo $postRepo)
    {
        $newPost = $postRepo->storePost($request->all());
        return $this->successResponse(new PostResource($newPost->load(["user", "categories"])), 201, "the post was saved !");
    }


    public function show(Post $post)
    {
        return $this->successResponse(new PostResource($post->load(["user", "categories", "comments"])->loadCount("likes", "comments")), 200, null);
    }


    public function update(PostRequest $request, Post $post, PostRepo $postRepo)
    {
        $postRepo->updatePost($post, $request->all());
        return $this->successResponse(new PostResource($post->load("user")), 200, "the post was updated successfully");
    }


    public function destroy(Post $post, PostRepo $postRepo)
    {
        $postRepo->deletePost($post);
        return $this->successResponse(new PostResource($post->load("user")), 200, "the post has been deleted !");
    }
}
