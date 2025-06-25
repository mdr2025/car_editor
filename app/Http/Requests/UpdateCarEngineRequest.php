<?php

namespace App\Http\Requests\CarEngine;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarEngineRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان المستخدم مصرح له بتنفيذ هذا الطلب.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * الحصول على قواعد التحقق التي تنطبق على الطلب.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'car_id' => 'sometimes|integer|exists:cars,car_id',
            'engine_name' => 'sometimes|string|max:50',
            'engine_capacity' => 'sometimes|numeric',
            'transmission_type' => 'sometimes|string',
            'fuel_type' => 'sometimes|string',
            'fuel_tank_capacity' => 'sometimes|numeric',
            'max_speed' => 'nullable|integer',
            'acceleration' => 'nullable|numeric',
            'breaking_distance' => 'nullable|numeric',
            'max_power' => 'nullable|numeric',
            'max_torque' => 'nullable|numeric',
            'number_cylinders' => 'nullable|integer',
            'valves_of_cylinders' => 'nullable|integer',
        ];
    }

    /**
     * الحصول على رسائل الخطأ المخصصة لقواعد التحقق.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'car_id.integer' => 'يجب أن يكون معرف السيارة رقمًا صحيحًا',
            'car_id.exists' => 'معرف السيارة المحدد غير موجود',
            'engine_name.string' => 'يجب أن يكون اسم المحرك نصًا',
            'engine_name.max' => 'يجب ألا يتجاوز اسم المحرك 50 حرفًا',
            'engine_capacity.numeric' => 'يجب أن تكون سعة المحرك رقمًا',
            'transmission_type.string' => 'يجب أن يكون نوع ناقل الحركة نصًا',
            'fuel_type.string' => 'يجب أن يكون نوع الوقود نصًا',
            'fuel_tank_capacity.numeric' => 'يجب أن تكون سعة خزان الوقود رقمًا',
        ];
    }
}
