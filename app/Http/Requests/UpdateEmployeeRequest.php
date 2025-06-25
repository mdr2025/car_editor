<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'showroom_id' => 'sometimes|integer|exists:showrooms,showroom_id',
            'hire_date' => 'sometimes|date',
            'position' => 'nullable|string|max:50',
            'salary' => 'nullable|numeric|min:0',
            'department' => 'nullable|string|max:50',
            'employee_status' => 'nullable|string|max:100',
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
            'showroom_id.integer' => 'يجب أن يكون معرف صالة العرض رقمًا صحيحًا',
            'showroom_id.exists' => 'معرف صالة العرض المحدد غير موجود',
            'hire_date.date' => 'يجب أن يكون تاريخ التوظيف تاريخًا صالحًا',
            'position.string' => 'يجب أن يكون المنصب نصًا',
            'position.max' => 'يجب ألا يتجاوز المنصب 50 حرفًا',
            'salary.numeric' => 'يجب أن يكون الراتب رقمًا',
            'salary.min' => 'يجب أن يكون الراتب على الأقل 0',
            'department.string' => 'يجب أن يكون القسم نصًا',
            'department.max' => 'يجب ألا يتجاوز القسم 50 حرفًا',
            'employee_status.string' => 'يجب أن تكون حالة الموظف نصًا',
            'employee_status.max' => 'يجب ألا تتجاوز حالة الموظف 100 حرف',
            'notes.string' => 'يجب أن تكون الملاحظات نصًا',
            'notes.max' => 'يجب ألا تتجاوز الملاحظات 255 حرفًا',
        ];
    }
}
