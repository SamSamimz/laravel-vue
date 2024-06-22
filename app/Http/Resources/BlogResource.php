<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'source_link' => $this->source_link,
            'category' => [
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ],
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
        ];
    }
}
