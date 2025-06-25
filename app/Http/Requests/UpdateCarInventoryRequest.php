<?php

namespace App\Http\Requests\CarInventory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarInventoryRequest extends FormRequest
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
            'showroom_id' => 'sometimes|integer|exists:showrooms,showroom_id',
            'quantity' => 'sometimes|integer',
            'available_status' => 'sometimes|string',
            'notes' => 'nullable|string|max:255',
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
            'showroom_id.integer' => 'يجب أن يكون معرف صالة العرض رقمًا صحيحًا',
            'showroom_id.exists' => 'معرف صالة العرض المحدد غير موجود',
            'quantity.integer' => 'يجب أن تكون الكمية رقمًا صحيحًا',
            'available_status.string' => 'يجب أن تكون حالة التوفر نصًا',
            'notes.string' => 'يجب أن تكون الملاحظات نصًا',
            'notes.max' => 'يجب ألا تتجاوز الملاحظات 255 حرفًا',
        ];
    }
}
