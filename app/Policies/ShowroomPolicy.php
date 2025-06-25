<?php

namespace App\Policies;

use App\Models\Showroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShowroomPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة المعارض.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن لجميع المستخدمين المصرح لهم عرض قائمة المعارض
        return true;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض المعرض.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Showroom  $showroom
     * @return bool
     */
    public function view(User $user, Showroom $showroom): bool
    {
        // يمكن لجميع المستخدمين المصرح لهم عرض تفاصيل المعرض
        return true;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء معارض.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن فقط للمسؤول إنشاء معارض جديدة
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث المعرض.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Showroom  $showroom
     * @return bool
     */
    public function update(User $user, Showroom $showroom): bool
    {
        // يمكن للمسؤول تحديث أي معرض
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن لمدير المعرض تحديث معرضه فقط
        if ($user->isShowroomManager()) {
            $employee = $user->employee;
            if ($employee && $employee->showroom_id === $showroom->showroom_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف المعرض.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Showroom  $showroom
     * @return bool
     */
    public function delete(User $user, Showroom $showroom): bool
    {
        // يمكن فقط للمسؤول حذف المعارض
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة المعرض المحذوف.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Showroom  $showroom
     * @return bool
     */
    public function restore(User $user, Showroom $showroom): bool
    {
        // يمكن فقط للمسؤول استعادة المعارض المحذوفة
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف المعرض نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Showroom  $showroom
     * @return bool
     */
    public function forceDelete(User $user, Showroom $showroom): bool
    {
        // يمكن فقط للمسؤول حذف المعارض نهائياً
        return $user->isAdmin();
    }
}
