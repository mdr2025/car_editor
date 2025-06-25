<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'profile_image_url' => $this->profile_image_url,
            'customer' => $this->whenLoaded('customer'),
            'employee' => $this->whenLoaded('employee'),
        ];
    }
}
