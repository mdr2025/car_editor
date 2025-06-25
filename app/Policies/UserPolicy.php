<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض أي مستخدم.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isShowroomManager();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض المستخدم.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->isShowroomManager() || $user->user_id === $model->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء مستخدمين.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث المستخدم.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->user_id === $model->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف المستخدم.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin() && $user->user_id !== $model->user_id;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة المستخدم.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return bool
     */
    public function restore(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف المستخدم نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return bool
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->isAdmin() && $user->user_id !== $model->user_id;
    }
}
