<?php

namespace Nrz\Post\Database\Repo;

use Nrz\Media\Services\MediaFileService;
use Nrz\Post\Events\PostImageDeleteEvent;
use Nrz\Post\Models\Post;

class PostRepo
{

    protected function getQuery()
    {
        return Post::query()->withCount(["likes", "comments"]);
    }

    public function storePost($data)
    {
        $newPost = $this->getQuery()->create([
            "title" => $data["title"],
            "description" => $data["description"],
            "media_id" => $this->uploadImg($data, "image", null),
            "user_id" => 1,
        ]);
        if ($newPost && array_key_exists("categories", $data))
            $this->syncCategoryForPost($newPost, $data["categories"]);
        return $newPost;
    }

    public function getPostWithPaginate($arr = [])
    {
        return $this->getQuery()->with($arr)->latest()->paginate(25);
    }

    public function updatePost(Post $post, $data)
    {
        if (array_key_exists("categories", $data))
            $this->syncCategoryForPost($post, $data["categories"]);
        if ($post->media and array_key_exists('image', $data))
            event(new PostImageDeleteEvent($post));
        return $post->update([
            "title" => $data["title"],
            "description" => $data["description"],
            "media_id" => $this->uploadImg($data, "image", $post->media_id),
        ]);
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        event(new PostImageDeleteEvent($post));
    }

    protected function uploadImg($arr, $key, $defaultValue = null)
    {

        return array_key_exists($key, $arr)
            ? MediaFileService::publicUpload($arr[$key], "post-image")->id
            : $defaultValue;
    }

    protected function syncCategoryForPost(Post $post, array $categories)
    {
        return $post->categories()->sync($categories);
    }

}
