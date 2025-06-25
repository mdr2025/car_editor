<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'visit_id' => $this->visit_id,
            'showroom_id' => $this->showroom_id,
            'customer_id' => $this->customer_id,
            'visit_date' => $this->visit_date,
            'notes' => $this->notes,
            'customer' => $this->whenLoaded('customer'),
            'showroom' => $this->whenLoaded('showroom'),
        ];
    }
}
