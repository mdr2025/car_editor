<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:female,male',
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
            'address.string' => 'يجب أن يكون العنوان نصًا',
            'address.max' => 'يجب ألا يتجاوز العنوان 255 حرفًا',
            'birth_date.date' => 'يجب أن يكون تاريخ الميلاد تاريخًا صالحًا',
            'gender.in' => 'قيمة الجنس غير صالحة',
        ];
    }
}
