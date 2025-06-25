<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'sale_id' => $this->sale_id,
            'customer_id' => $this->customer_id,
            'car_id' => $this->car_id,
            'employee_id' => $this->employee_id,
            'payment_method' => $this->payment_method,
            'sale_date' => $this->sale_date,
            'total_price' => $this->total_price,
            'tax' => $this->tax,
            'notes' => $this->notes,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'car' => new CarResource($this->whenLoaded('car')),
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}
