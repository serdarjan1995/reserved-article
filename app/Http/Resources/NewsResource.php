<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'creation_date' => $this->creation_date->format('d M Y H:i'),
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
        ];
        return array_merge($data, (new AuthorResource($this->user))->toArray($request));
    }
}
