<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'car_id' => $this->car_id,
            'inventory_id' => $this->inventory_id,
            'car_name' => $this->car_name,
            'model_year' => $this->model_year,
            'color' => $this->color,
            'vin' => $this->vin,
            'seats' => $this->seats,
            'price' => $this->price,
            'image_path_url' => $this->image_path_url,
            'wheels' => $this->wheels,
            'tires' => $this->tires,
            'overall_length' => $this->overall_length,
            'overall_width' => $this->overall_width,
            'overall_height' => $this->overall_height,
            'wheel_base' => $this->wheel_base,
            'front_wheel_tread' => $this->front_wheel_tread,
            'rear_wheel_tread' => $this->rear_wheel_tread,
            'lightest_curb_weight' => $this->lightest_curb_weight,
            'heaviest_curb_weight' => $this->heaviest_curb_weight,
            'gross_curb_weight' => $this->gross_curb_weight,
            'engine' => $this->whenLoaded('engine'),
            'inventory' => $this->whenLoaded('inventory'),
            'sale' => $this->whenLoaded('sale'),
        ];
    }
}
