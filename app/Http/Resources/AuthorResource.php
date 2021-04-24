<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'author' => $this->id,
            'author_name' => $this->name,
            'author_email' => $this->email,
            'author_photo' => $this->photo,
            'author_registration_date' => $this->registration_date->format('d M Y H:i'),
        ];
    }
}
