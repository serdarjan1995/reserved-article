<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'creation_date' => $this->creation_date->getTimestamp(),
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'author' => $this->author_id,
        ];
    }
}
