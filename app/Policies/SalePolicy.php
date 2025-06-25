<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض قائمة المبيعات.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات عرض قائمة المبيعات
        return $user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه عرض عملية بيع معينة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return bool
     */
    public function view(User $user, Sale $sale): bool
    {
        // يمكن للمسؤول عرض أي عملية بيع
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن لمدير المعرض عرض عمليات البيع التي تمت بواسطة موظفي معرضه
        if ($user->isShowroomManager()) {
            $manager = $user->employee;
            $employee = $sale->employee;
            
            if ($manager && $employee && $manager->showroom_id === $employee->showroom_id) {
                return true;
            }
        }
        
        // يمكن لموظف المبيعات عرض عمليات البيع التي قام بها
        if ($user->isSalesEmployee()) {
            $employee = $user->employee;
            
            if ($employee && $employee->employee_id === $sale->employee_id) {
                return true;
            }
        }
        
        // يمكن للعميل عرض عمليات البيع الخاصة به
        if ($user->isCustomer()) {
            $customer = $user->customer;
            
            if ($customer && $customer->customer_id === $sale->customer_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه إنشاء عملية بيع.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // يمكن للمسؤول ومدير المعرض وموظف المبيعات إنشاء عمليات بيع جديدة
        return $user->isAdmin() || $user->isShowroomManager() || $user->isSalesEmployee();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه تحديث عملية بيع معينة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return bool
     */
    public function update(User $user, Sale $sale): bool
    {
        // يمكن للمسؤول تحديث أي عملية بيع
        if ($user->isAdmin()) {
            return true;
        }
        
        // يمكن لمدير المعرض تحديث عمليات البيع التي تمت بواسطة موظفي معرضه
        if ($user->isShowroomManager()) {
            $manager = $user->employee;
            $employee = $sale->employee;
            
            if ($manager && $employee && $manager->showroom_id === $employee->showroom_id) {
                return true;
            }
        }
        
        // يمكن لموظف المبيعات تحديث عمليات البيع التي قام بها
        if ($user->isSalesEmployee()) {
            $employee = $user->employee;
            
            if ($employee && $employee->employee_id === $sale->employee_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف عملية بيع معينة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return bool
     */
    public function delete(User $user, Sale $sale): bool
    {
        // يمكن فقط للمسؤول ومدير المعرض حذف عمليات البيع
        if ($user->isAdmin()) {
            return true;
        }
        
        if ($user->isShowroomManager()) {
            $manager = $user->employee;
            $employee = $sale->employee;
            
            if ($manager && $employee && $manager->showroom_id === $employee->showroom_id) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه استعادة عملية بيع محذوفة.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return bool
     */
    public function restore(User $user, Sale $sale): bool
    {
        // يمكن فقط للمسؤول استعادة عمليات البيع المحذوفة
        return $user->isAdmin();
    }

    /**
     * تحديد ما إذا كان المستخدم يمكنه حذف عملية بيع نهائياً.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return bool
     */
    public function forceDelete(User $user, Sale $sale): bool
    {
        // يمكن فقط للمسؤول حذف عمليات البيع نهائياً
        return $user->isAdmin();
    }
}
