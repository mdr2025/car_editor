<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'employee_id' => $this->employee_id,
            'user_id' => $this->user_id,
            'showroom_id' => $this->showroom_id,
            'hire_date' => $this->hire_date,
            'position' => $this->position,
            'salary' => $this->salary,
            'department' => $this->department,
            'employee_status' => $this->employee_status,
            'notes' => $this->notes,
            'user' => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'showroom' => $this->whenLoaded('showroom'),
            'sales' => $this->whenLoaded('sales'),
            'jobs' => $this->whenLoaded('jobs'),
        ];
    }
}
