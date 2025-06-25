<?php

namespace App\Policies;

use App\Models\CarInventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarInventoryPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة مخزون السيارات.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات عرض قائمة مخزون السيارات
        return $user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض مخزون السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarInventory  $carInventory
     * @return bool
     */
    public function view(User $user, CarInventory $carInventory): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات عرض تفاصيل مخزون السيارة
        return $user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء مخزون سيارات.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن فقط للمسؤول ومدير المعرض إنشاء مخزون سيارات جديد
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث مخزون السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarInventory  $carInventory
     * @return bool
     */
    public function update(User $user, CarInventory $carInventory): bool
    {
        // يمكن للمسؤول ومدير المعرض تحديث مخزون السيارات
        // يمكن لمدير المعرض تحديث مخزون السيارات في معرضه فقط
        if ($user->isAdmin()) {
            return true;
        }
        
        if ($user->isShowroomManager()) {
            // التحقق من أن المستخدم هو مدير المعرض الذي ينتمي إليه المخزون
            $employee = $user->employee;
            if ($employee && $employee->showroom_id === $carInventory->showroom_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف مخزون السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarInventory  $carInventory
     * @return bool
     */
    public function delete(User $user, CarInventory $carInventory): bool
    {
        // يمكن فقط للمسؤول ومدير المعرض حذف مخزون السيارات
        // يمكن لمدير المعرض حذف مخزون السيارات في معرضه فقط
        if ($user->isAdmin()) {
            return true;
        }
        
        if ($user->isShowroomManager()) {
            // التحقق من أن المستخدم هو مدير المعرض الذي ينتمي إليه المخزون
            $employee = $user->employee;
            if ($employee && $employee->showroom_id === $carInventory->showroom_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة مخزون السيارة المحذوف.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarInventory  $carInventory
     * @return bool
     */
    public function restore(User $user, CarInventory $carInventory): bool
    {
        // يمكن فقط للمسؤول استعادة مخزون السيارات المحذوف
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف مخزون السيارة نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarInventory  $carInventory
     * @return bool
     */
    public function forceDelete(User $user, CarInventory $carInventory): bool
    {
        // يمكن فقط للمسؤول حذف مخزون السيارات نهائياً
        return $user->isAdmin();
    }
}
