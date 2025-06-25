<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض أي سيارة.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true; // يمكن لأي مستخدم مصادق عليه عرض قائمة السيارات
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return bool
     */
    public function view(?User $user, Car $car): bool
    {
        return true; // يمكن لأي شخص عرض تفاصيل السيارة
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء سيارات.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return bool
     */
    public function update(User $user, Car $car): bool
    {
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return bool
     */
    public function delete(User $user, Car $car): bool
    {
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة السيارة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return bool
     */
    public function restore(User $user, Car $car): bool
    {
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف السيارة نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return bool
     */
    public function forceDelete(User $user, Car $car): bool
    {
        return $user->isAdmin();
    }



}
