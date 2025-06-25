<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
        $car = $this->route('car');

        return [
            'car_name' => 'sometimes|string|max:50|unique:cars,car_name,' . $car->car_id . ',car_id',
            'model_year' => 'sometimes|integer',
            'color' => 'sometimes|string|max:20',
            'vin' => 'sometimes|string|max:50|unique:cars,vin,' . $car->car_id . ',car_id',
            'seats' => 'sometimes|in:2,4,5,6,12',
            'price' => 'sometimes|integer|min:0',
            'image_path_url' => 'nullable|string|max:255',
            'wheels' => 'nullable|string|max:30',
            'tires' => 'nullable|string|max:30',
            'overall_length' => 'nullable|numeric',
            'overall_width' => 'nullable|numeric',
            'overall_height' => 'nullable|numeric',
            'wheel_base' => 'nullable|numeric',
            'front_wheel_tread' => 'nullable|numeric',
            'rear_wheel_tread' => 'nullable|numeric',
            'lightest_curb_weight' => 'nullable|numeric',
            'heaviest_curb_weight' => 'nullable|numeric',
            'gross_curb_weight' => 'nullable|numeric',
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
            'car_name.string' => 'يجب أن يكون اسم السيارة نصًا',
            'car_name.max' => 'يجب ألا يتجاوز اسم السيارة 50 حرفًا',
            'car_name.unique' => 'اسم السيارة مستخدم بالفعل',
            'model_year.integer' => 'يجب أن تكون سنة الموديل رقمًا صحيحًا',
            'color.string' => 'يجب أن يكون اللون نصًا',
            'color.max' => 'يجب ألا يتجاوز اللون 20 حرفًا',
            'vin.string' => 'يجب أن يكون رقم التعريف (VIN) نصًا',
            'vin.max' => 'يجب ألا يتجاوز رقم التعريف (VIN) 50 حرفًا',
            'vin.unique' => 'رقم التعريف (VIN) مستخدم بالفعل',
            'seats.in' => 'قيمة المقاعد غير صالحة',
            'price.integer' => 'يجب أن يكون السعر رقمًا صحيحًا',
            'price.min' => 'يجب أن يكون السعر على الأقل 0',
        ];
    }
}
