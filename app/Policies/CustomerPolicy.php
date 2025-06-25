<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة العملاء.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات عرض قائمة العملاء
        return $user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض عميل معين.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return bool
     */
    public function view(User $user, Customer $customer): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات عرض تفاصيل أي عميل
        if ($user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee()) {
            return true;
        }
        
        // يمكن للعميل عرض بياناته الشخصية فقط
        return $user->user_id === $customer->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء عملاء.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات إنشاء عملاء جدد
        return $user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث عميل معين.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return bool
     */
    public function update(User $user, Customer $customer): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات تحديث بيانات أي عميل
        if ($user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee()) {
            return true;
        }
        
        // يمكن للعميل تحديث بياناته الشخصية فقط
        return $user->user_id === $customer->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف عميل معين.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return bool
     */
    public function delete(User $user, Customer $customer): bool
    {
        // يمكن فقط للمسؤول حذف العملاء
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة عميل محذوف.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return bool
     */
    public function restore(User $user, Customer $customer): bool
    {
        // يمكن فقط للمسؤول استعادة العملاء المحذوفين
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف عميل نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return bool
     */
    public function forceDelete(User $user, Customer $customer): bool
    {
        // يمكن فقط للمسؤول حذف العملاء نهائياً
        return $user->isAdmin();
    }
}
