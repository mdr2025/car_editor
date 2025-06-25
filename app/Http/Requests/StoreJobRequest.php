<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'showroom_id' => 'required|integer|exists:showrooms,showroom_id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'working_status' => 'nullable|string|max:100',
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
            'employee_id.required' => 'حقل معرف الموظف مطلوب',
            'employee_id.integer' => 'يجب أن يكون معرف الموظف رقمًا صحيحًا',
            'employee_id.exists' => 'معرف الموظف المحدد غير موجود',
            'showroom_id.required' => 'حقل معرف صالة العرض مطلوب',
            'showroom_id.integer' => 'يجب أن يكون معرف صالة العرض رقمًا صحيحًا',
            'showroom_id.exists' => 'معرف صالة العرض المحدد غير موجود',
            'start_date.required' => 'حقل تاريخ البدء مطلوب',
            'start_date.date' => 'يجب أن يكون تاريخ البدء تاريخًا صالحًا',
            'end_date.date' => 'يجب أن يكون تاريخ الانتهاء تاريخًا صالحًا',
            'end_date.after_or_equal' => 'يجب أن يكون تاريخ الانتهاء بعد أو يساوي تاريخ البدء',
            'working_status.string' => 'يجب أن تكون حالة العمل نصًا',
            'working_status.max' => 'يجب ألا تتجاوز حالة العمل 100 حرف',
            'notes.string' => 'يجب أن تكون الملاحظات نصًا',
            'notes.max' => 'يجب ألا تتجاوز الملاحظات 255 حرفًا',
        ];
    }
}
