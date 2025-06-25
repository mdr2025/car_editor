<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerBankAccountResource extends JsonResource
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
            'account_id' => $this->account_id,
            'customer_id' => $this->customer_id,
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
            'account_holder_name' => $this->account_holder_name,
            'iban' => $this->iban,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
        ];
    }
}
