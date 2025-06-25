<?php

namespace App\Policies;

use App\Models\CarEngine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarEnginePolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة محركات السيارات.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن لجميع المستخدمين المصرح لهم عرض قائمة محركات السيارات
        return true;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض محرك السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarEngine  $carEngine
     * @return bool
     */
    public function view(User $user, CarEngine $carEngine): bool
    {
        // يمكن لجميع المستخدمين المصرح لهم عرض تفاصيل محرك السيارة
        return true;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء محركات سيارات.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن فقط للمسؤول ومدير المعرض إنشاء محركات سيارات جديدة
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث محرك السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarEngine  $carEngine
     * @return bool
     */
    public function update(User $user, CarEngine $carEngine): bool
    {
        // يمكن فقط للمسؤول ومدير المعرض تحديث محركات السيارات
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف محرك السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarEngine  $carEngine
     * @return bool
     */
    public function delete(User $user, CarEngine $carEngine): bool
    {
        // يمكن فقط للمسؤول حذف محركات السيارات
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة محرك السيارة المحذوف.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarEngine  $carEngine
     * @return bool
     */
    public function restore(User $user, CarEngine $carEngine): bool
    {
        // يمكن فقط للمسؤول استعادة محركات السيارات المحذوفة
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف محرك السيارة نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarEngine  $carEngine
     * @return bool
     */
    public function forceDelete(User $user, CarEngine $carEngine): bool
    {
        // يمكن فقط للمسؤول حذف محركات السيارات نهائياً
        return $user->isAdmin();
    }
}
