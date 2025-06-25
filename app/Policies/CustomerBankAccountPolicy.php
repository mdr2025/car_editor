<?php

namespace App\Policies;

use App\Models\CustomerBankAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerBankAccountPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة الحسابات البنكية للعملاء.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض عرض قائمة الحسابات البنكية للعملاء
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض حساب بنكي معين للعميل.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return bool
     */
    public function view(User $user, CustomerBankAccount $customerBankAccount): bool
    {
        // يمكن للمسؤول عرض أي حساب بنكي
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن لمدير المعرض عرض الحسابات البنكية للعملاء
        if ($user->isShowroomManager()) {
            return true;
        }
        
        // يمكن للعميل عرض حساباته البنكية فقط
        if ($user->isCustomer()) {
            $customer = $user->customer;
            
            if ($customer && $customer->customer_id === $customerBankAccount->customer_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء حساب بنكي للعميل.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات إنشاء حسابات بنكية للعملاء
        if ($user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee()) {
            return true;
        }
        
        // يمكن للعميل إنشاء حساب بنكي لنفسه
        if ($user->isCustomer()) {
            return true;
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث حساب بنكي معين للعميل.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return bool
     */
    public function update(User $user, CustomerBankAccount $customerBankAccount): bool
    {
        // يمكن للمسؤول تحديث أي حساب بنكي
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن لمدير المعرض تحديث الحسابات البنكية للعملاء
        if ($user->isShowroomManager()) {
            return true;
        }
        
        // يمكن للعميل تحديث حساباته البنكية فقط
        if ($user->isCustomer()) {
            $customer = $user->customer;
            
            if ($customer && $customer->customer_id === $customerBankAccount->customer_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف حساب بنكي معين للعميل.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return bool
     */
    public function delete(User $user, CustomerBankAccount $customerBankAccount): bool
    {
        // يمكن للمسؤول حذف أي حساب بنكي
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن للعميل حذف حساباته البنكية فقط
        if ($user->isCustomer()) {
            $customer = $user->customer;
            
            if ($customer && $customer->customer_id === $customerBankAccount->customer_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة حساب بنكي محذوف للعميل.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return bool
     */
    public function restore(User $user, CustomerBankAccount $customerBankAccount): bool
    {
        // يمكن فقط للمسؤول استعادة الحسابات البنكية المحذوفة
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف حساب بنكي نهائياً للعميل.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CustomerBankAccount  $customerBankAccount
     * @return bool
     */
    public function forceDelete(User $user, CustomerBankAccount $customerBankAccount): bool
    {
        // يمكن فقط للمسؤول حذف الحسابات البنكية نهائياً
        return $user->isAdmin();
    }
}
