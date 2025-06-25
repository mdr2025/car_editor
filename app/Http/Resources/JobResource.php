<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * تحويل المورد إلى مصفوفة.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'job_id' => $this->job_id,
            'employee_id' => $this->employee_id,
            'showroom_id' => $this->showroom_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'working_status' => $this->working_status,
            'notes' => $this->notes,
            'employee' => $this->whenLoaded('employee'),
            'showroom' => $this->whenLoaded('showroom'),
        ];
    }
}
