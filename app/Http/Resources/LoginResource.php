<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'login_id' => $this->login_id,
            'user_id' => $this->user_id,
            'username' => $this->username,
            // لا نقوم بإرجاع كلمة المرور لأسباب أمنية
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
