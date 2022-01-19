<?php

namespace Nrz\Post\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Nrz\Category\Http\Resources\CategoryResource;
use Nrz\Media\Http\Resources\MediaResource;
use Nrz\User\Http\Resources\V1\UserResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "author" => new UserResource($this->whenLoaded("user")),
            "description" => $this->description,
            "update at" => $this->updated_at->format("Y-m-d H:i"),
            "likes_count" => $this->likes_count,
            "comments_count" => $this->comments_count,
            "comments" => CommentResource::collection($this->whenLoaded("comments")),
            "categories" => CategoryResource::collection($this->whenLoaded("categories")),
            "media" => new MediaResource($this->whenLoaded("media"))
        ];
    }
}
