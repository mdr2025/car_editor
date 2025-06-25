<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'customer_id' => $this->customer_id,
            'user_id' => $this->user_id,
            'address' => $this->address,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'user' => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'bank_accounts' => $this->whenLoaded('bankAccounts'),
            'sales' => $this->whenLoaded('sales'),
            'visits' => $this->whenLoaded('visits'),
        ];
    }
}
