<?php

namespace App\Policies;

use App\Models\Login;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoginPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة بيانات تسجيل الدخول.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن فقط للمسؤول عرض قائمة بيانات تسجيل الدخول
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض بيانات تسجيل الدخول.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Login  $login
     * @return bool
     */
    public function view(User $user, Login $login): bool
    {
        // يمكن للمسؤول عرض أي بيانات تسجيل دخول
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن للمستخدم عرض بيانات تسجيل الدخول الخاصة به فقط
        return $user->user_id === $login->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء بيانات تسجيل دخول.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن فقط للمسؤول إنشاء بيانات تسجيل دخول جديدة
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث بيانات تسجيل الدخول.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Login  $login
     * @return bool
     */
    public function update(User $user, Login $login): bool
    {
        // يمكن للمسؤول تحديث أي بيانات تسجيل دخول
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن للمستخدم تحديث بيانات تسجيل الدخول الخاصة به فقط
        return $user->user_id === $login->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف بيانات تسجيل الدخول.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Login  $login
     * @return bool
     */
    public function delete(User $user, Login $login): bool
    {
        // يمكن فقط للمسؤول حذف بيانات تسجيل الدخول
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة بيانات تسجيل الدخ��ل المحذوفة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Login  $login
     * @return bool
     */
    public function restore(User $user, Login $login): bool
    {
        // يمكن فقط للمسؤول استعادة بيانات تسجيل الدخول المحذوفة
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف بيانات تسجيل الدخول نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Login  $login
     * @return bool
     */
    public function forceDelete(User $user, Login $login): bool
    {
        // يمكن فقط للمسؤول حذف بيانات تسجيل الدخول نهائياً
        return $user->isAdmin();
    }
}
