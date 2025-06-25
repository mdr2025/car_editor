<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoginRequest extends FormRequest
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
        $login = $this->route('login');
        
        return [
            'user_id' => 'sometimes|integer|exists:users,user_id|unique:login,user_id,' . $login->login_id . ',login_id',
            'username' => 'sometimes|string|max:50|unique:login,username,' . $login->login_id . ',login_id',
            'password' => 'sometimes|string|min:8|max:100',
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
            'user_id.integer' => 'يجب أن يكون معرف المستخدم رقمًا صحيحًا',
            'user_id.exists' => 'معرف المستخدم المحدد غير موجود',
            'user_id.unique' => 'معرف المستخدم مستخدم بالفعل',
            'username.string' => 'يجب أن يكون اسم المستخدم نصًا',
            'username.max' => 'يجب ألا يتجاوز اسم المستخدم 50 حرفًا',
            'username.unique' => 'اسم المستخدم مستخدم بالفعل',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا',
            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل',
            'password.max' => 'يجب ألا تتجاوز كلمة المرور 100 حرف',
        ];
    }
}
