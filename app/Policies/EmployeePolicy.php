<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة الموظفين.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض عرض قائمة الموظفين
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض موظف معين.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employee  $employee
     * @return bool
     */
    public function view(User $user, Employee $employee): bool
    {
        // يمكن للمسؤول عرض أي موظف
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن لمدير المعرض عرض الموظفين في معرضه فقط
        if ($user->isShowroomManager()) {
            $manager = $user->employee;
            if ($manager && $manager->showroom_id === $employee->showroom_id) {
                return true;
            }
        }
        
        // يمكن للموظف عرض بياناته الشخصية فقط
        return $user->user_id === $employee->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء موظفين.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن فقط للمسؤول إنشاء موظفين جدد
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث موظف معين.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employee  $employee
     * @return bool
     */
    public function update(User $user, Employee $employee): bool
    {
        // يمكن للمسؤول تحديث أي موظف
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن لمدير المعرض تحديث بيانات الموظفين في معرضه فقط
        if ($user->isShowroomManager()) {
            $manager = $user->employee;
            if ($manager && $manager->showroom_id === $employee->showroom_id) {
                return true;
            }
        }
        
        // يمكن للموظف تحديث بعض بياناته الشخصية فقط
        return $user->user_id === $employee->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف موظف معين.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employee  $employee
     * @return bool
     */
    public function delete(User $user, Employee $employee): bool
    {
        // يمكن فقط للمسؤول حذف الموظفين
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة موظف محذوف.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employee  $employee
     * @return bool
     */
    public function restore(User $user, Employee $employee): bool
    {
        // يمكن فقط للمسؤول استعادة الموظفين المحذوفين
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف موظف نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employee  $employee
     * @return bool
     */
    public function forceDelete(User $user, Employee $employee): bool
    {
        // يمكن فقط للمسؤول حذف الموظفين نهائياً
        return $user->isAdmin();
    }
}
