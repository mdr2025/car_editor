<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarInventoryResource extends JsonResource
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
            'inventory_id' => $this->inventory_id,
            'car_id' => $this->car_id,
            'showroom_id' => $this->showroom_id,
            'quantity' => $this->quantity,
            'available_status' => $this->available_status,
            'notes' => $this->notes,
            'car' => new CarResource($this->whenLoaded('car')),
            'showroom' => new ShowroomResource($this->whenLoaded('showroom')),
        ];
    }
}
