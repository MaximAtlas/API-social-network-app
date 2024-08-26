<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Post */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'photo' => $this->photo,
            'description' => $this->description,
            'created at' => $this->created_at->format('d-m-Y-H-i-s'),
            'updated at' => $this->updated_at->format('d-m-Y-H-i-s'),
        ];
    }
}
