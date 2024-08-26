<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class CurrentUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'login' => $this->login,
            'about' => $this->about,
            'avatar' => $this->avatar,
            'is verified' => (bool) $this->is_verified,
            'register at' => $this->created_at->format('d-m-Y-H-i-s'),
            'subscribers' => $this->subscriptionsCount(),
            'publications' => $this->postscount(),

        ];
    }
}
