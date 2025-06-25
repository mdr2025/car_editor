<?php

namespace App\Http\Requests\CustomerBankAccount;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerBankAccountRequest extends FormRequest
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
            'customer_id' => 'required|integer|exists:customers,customer_id',
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:30',
            'account_holder_name' => 'required|string|max:50',
            'iban' => 'required|string|max:50',
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
            'customer_id.required' => 'حقل معرف العميل مطلوب',
            'customer_id.integer' => 'يجب أن يكون معرف العميل رقمًا صحيحًا',
            'customer_id.exists' => 'معرف العميل المحدد غير موجود',
            'bank_name.required' => 'حقل اسم البنك مطلوب',
            'bank_name.string' => 'يجب أن يكون اسم البنك نصًا',
            'bank_name.max' => 'يجب ألا يتجاوز اسم البنك 50 حرفًا',
            'account_number.required' => 'حقل رقم الحساب مطلوب',
            'account_number.string' => 'يجب أن يكون رقم الحساب نصًا',
            'account_number.max' => 'يجب ألا يتجاوز رقم الحساب 30 حرفًا',
            'account_holder_name.required' => 'حقل اسم صاحب الحساب مطلوب',
            'account_holder_name.string' => 'يجب أن يكون اسم صاحب الحساب نصًا',
            'account_holder_name.max' => 'يجب ألا يتجاوز اسم صاحب الحساب 50 حرفًا',
            'iban.required' => 'حقل رقم الآيبان مطلوب',
            'iban.string' => 'يجب أن يكون رقم الآيبان نصًا',
            'iban.max' => 'يجب ألا يتجاوز رقم الآيبان 50 حرفًا',
        ];
    }
}
