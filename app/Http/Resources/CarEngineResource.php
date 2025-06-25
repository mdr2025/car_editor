<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarEngineResource extends JsonResource
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
            'engine_id' => $this->engine_id,
            'car_id' => $this->car_id,
            'engine_name' => $this->engine_name,
            'engine_capacity' => $this->engine_capacity,
            'transmission_type' => $this->transmission_type,
            'fuel_type' => $this->fuel_type,
            'fuel_tank_capacity' => $this->fuel_tank_capacity,
            'max_speed' => $this->max_speed,
            'acceleration' => $this->acceleration,
            'breaking_distance' => $this->breaking_distance,
            'max_power' => $this->max_power,
            'max_torque' => $this->max_torque,
            'displacement' => $this->displacement,
            'number_cylinders' => $this->number_cylinders,
            'valves_of_cylinders' => $this->valves_of_cylinders,
            'car' => new CarResource($this->whenLoaded('car')),
        ];
    }
}
