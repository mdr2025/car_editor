<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,user_id|unique:login,user_id',
            'username' => 'required|string|max:50|unique:login',
            'password' => 'required|string|min:8|max:100',
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
            'user_id.required' => 'حقل معرف المستخدم مطلوب',
            'user_id.integer' => 'يجب أن يكون معرف المستخدم رقمًا صحيحًا',
            'user_id.exists' => 'معرف المستخدم المحدد غير موجود',
            'user_id.unique' => 'معرف المستخدم مستخدم بالفعل',
            'username.required' => 'حقل اسم المستخدم مطلوب',
            'username.string' => 'يجب أن يكون اسم المستخدم نصًا',
            'username.max' => 'يجب ألا يتجاوز اسم المستخدم 50 حرفًا',
            'username.unique' => 'اسم المستخدم مستخدم بالفعل',
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا',
            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل',
            'password.max' => 'يجب ألا تتجاوز كلمة المرور 100 حرف',
        ];
    }
}
