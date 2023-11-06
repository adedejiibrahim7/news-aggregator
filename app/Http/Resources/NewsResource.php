<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'body'          => $this->body,
            'source'        => $this->source,
            'author'        => $this->author,
            'url'           => $this->url,
            'image_url'     => $this->image_url,
            'category'      => $this->category,
            'published_at'  => $this->published_at
        ];
    }
}
