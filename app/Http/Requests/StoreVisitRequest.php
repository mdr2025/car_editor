<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
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
            'showroom_id' => 'required|integer|exists:showrooms,showroom_id',
            'customer_id' => 'required|integer|exists:customers,customer_id',
            'visit_date' => 'nullable|date',
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
            'showroom_id.required' => 'حقل معرف المعرض مطلوب',
            'showroom_id.integer' => 'يجب أن يكون معرف المعرض رقمًا صحيحًا',
            'showroom_id.exists' => 'معرف المعرض المحدد غير موجود',
            'customer_id.required' => 'حقل معرف العميل مطلوب',
            'customer_id.integer' => 'يجب أن يكون معرف العميل رقمًا صحيحًا',
            'customer_id.exists' => 'معرف العميل المحدد غير موجود',
            'visit_date.date' => 'يجب أن يكون تاريخ الزيارة تاريخًا صالحًا',
            'notes.string' => 'يجب أن تكون الملاحظات نصًا',
            'notes.max' => 'يجب ألا تتجاوز الملاحظات 255 حرفًا',
        ];
    }
}
