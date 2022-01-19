<?php

namespace Nrz\Post\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            "message" => $this->message,
            "commentable_id" => $this->commentable_id,
            "commentable_type" => $this->commentable_type,
            "parent_id" => $this->parent_id,
            "create at" => $this->created_at->format("Y-m-d H:i")
        ];
    }
}
