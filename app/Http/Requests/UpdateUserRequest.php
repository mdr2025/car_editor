<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');
        
        return [
            'fullname' => 'sometimes|string|max:50',
            'username' => 'sometimes|string|max:50|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'password' => 'sometimes|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'sometimes|in:customer,employee,manager',
            'profile_image_url' => 'nullable|string|max:255',
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
            'fullname.string' => 'يجب أن يكون الاسم الكامل نصًا',
            'fullname.max' => 'يجب ألا يتجاوز الاسم الكامل 50 حرفًا',
            'username.string' => 'يجب أن يكون اسم المستخدم نصًا',
            'username.max' => 'يجب ألا يتجاوز اسم المستخدم 50 حرفًا',
            'username.unique' => 'اسم المستخدم مستخدم بالفعل',
            'email.string' => 'يجب أن يكون البريد الإلكتروني نصًا',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا',
            'email.max' => 'يجب ألا يتجاوز البريد الإلكتروني 255 حرفًا',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا',
            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
            'phone.string' => 'يجب أن يكون رقم الهاتف نصًا',
            'phone.max' => 'يجب ألا يتجاوز رقم الهاتف 20 حرفًا',
            'role.in' => 'قيمة الدور غير صالحة',
            'profile_image_url.string' => 'يجب أن يكون رابط صورة الملف الشخصي نصًا',
            'profile_image_url.max' => 'يجب ألا يتجاوز رابط صورة الملف الشخصي 255 حرفًا',
        ];
    }
}
