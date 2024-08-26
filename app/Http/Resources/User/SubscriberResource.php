<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subscription */
class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->subscriber->id,
            'name' => $this->subscriber->name,
            'login' => $this->subscriber->login,
            'avatar' => $this->subscriber->avatar,
            'is verified' => (bool) $this->subscriber->is_verified,
            'register at' => $this->subscriber->created_at->format('d-m-Y-H-i-s'),
        ];
    }
}
