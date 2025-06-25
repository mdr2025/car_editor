<?php

namespace App\Http\Requests\Showroom;

use Illuminate\Foundation\Http\FormRequest;

class StoreShowroomRequest extends FormRequest
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
            'showroom_name' => 'required|string|max:50',
            'location' => 'required|string|max:100',
            'showroom_phone' => 'nullable|string|max:30',
            'showroom_email' => 'nullable|email|max:100',
            'working_hour' => 'nullable|string|max:50',
            'showroom_status' => 'nullable|in:active,inactive,under_construction,temporarily_closed',
            'website_url' => 'nullable|string|max:255',
            'image_path' => 'nullable|string|max:255',
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
            'showroom_name.required' => 'حقل اسم المعرض مطلوب',
            'showroom_name.string' => 'يجب أن يكون اسم المعرض نصًا',
            'showroom_name.max' => 'يجب ألا يتجاوز اسم المعرض 50 حرفًا',
            'location.required' => 'حقل الموقع مطلوب',
            'location.string' => 'يجب أن يكون الموقع نصًا',
            'location.max' => 'يجب ألا يتجاوز الموقع 100 حرف',
            'showroom_phone.string' => 'يجب أن يكون هاتف المعرض نصًا',
            'showroom_phone.max' => 'يجب ألا يتجاوز هاتف المعرض 30 حرفًا',
            'showroom_email.email' => 'يجب أن يكون البريد الإلكتروني للمعرض صالحًا',
            'showroom_email.max' => 'يجب ألا يتجاوز البريد الإلكتروني للمعرض 100 حرف',
            'working_hour.string' => 'يجب أن تكون ساعات العمل نصًا',
            'working_hour.max' => 'يجب ألا تتجاوز ساعات العمل 50 حرفًا',
            'showroom_status.in' => 'قيمة حالة المعرض غير صالحة',
            'website_url.string' => 'يجب أن يكون رابط الموقع الإلكتروني نصًا',
            'website_url.max' => 'يجب ألا يتجاوز رابط الموقع الإلكتروني 255 حرفًا',
            'image_path.string' => 'يجب أن يكون مسار الصورة نصًا',
            'image_path.max' => 'يجب ألا يتجاوز مسار الصورة 255 حرفًا',
        ];
    }
}
