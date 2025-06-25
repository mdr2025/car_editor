<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowroomResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'showroom_id' => $this->showroom_id,
            'showroom_name' => $this->showroom_name,
            'location' => $this->location,
            'showroom_phone' => $this->showroom_phone,
            'showroom_email' => $this->showroom_email,
            'working_hour' => $this->working_hour,
            'showroom_status' => $this->showroom_status,
            'website_url' => $this->website_url,
            'image_path' => $this->image_path,
            'car_inventories' => $this->whenLoaded('carInventories'),
            'employees' => $this->whenLoaded('employees'),
            'jobs' => $this->whenLoaded('jobs'),
            'visits' => $this->whenLoaded('visits'),
            'showroom_stocks' => $this->whenLoaded('showroomStocks'),
        ];
    }
}
