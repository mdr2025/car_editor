<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
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
            'customer_id' => 'sometimes|integer|exists:customers,customer_id',
            'car_id' => 'sometimes|integer|exists:cars,car_id',
            'employee_id' => 'sometimes|integer|exists:employees,employee_id',
            'payment_method' => 'sometimes|string',
            'sale_date' => 'sometimes|date',
            'total_price' => 'sometimes|numeric',
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
            'customer_id.integer' => 'يجب أن يكون معرف العميل رقمًا صحيحًا',
            'customer_id.exists' => 'معرف العميل المحدد غير موجود',
            'car_id.integer' => 'يجب أن يكون معرف السيارة رقمًا صحيحًا',
            'car_id.exists' => 'معرف السيارة المحدد غير موجود',
            'employee_id.integer' => 'يجب أن يكون معرف الموظف رقمًا صحيحًا',
            'employee_id.exists' => 'معرف الموظف المحدد غير موجود',
            'payment_method.string' => 'يجب أن تكون طريقة الدفع نصًا',
            'sale_date.date' => 'يجب أن يكون تاريخ البيع تاريخًا صالحًا',
            'total_price.numeric' => 'يجب أن يكون السعر الإجمالي رقمًا',
            'notes.string' => 'يجب أن تكون الملاحظات نصًا',
            'notes.max' => 'يجب ألا تتجاوز الملاحظات 255 حرفًا',
        ];
    }
}
