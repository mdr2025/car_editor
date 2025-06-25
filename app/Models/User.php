<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * الخصائص التي يمكن تعيينها بشكل جماعي
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'user_name',
        'email',
        'password',
        'phone',
        'role',
        'profile_image_url',
    ];

    /**
     * الخصائص التي يجب إخفاؤها للمصفوفات
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * الحصول على العميل المرتبط بهذا المستخدم
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'user_id', 'user_id');
    }

    /**
     * الحصول على الموظف المرتبط بهذا المستخدم
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'user_id', 'user_id');
    }

    /**
     * التحقق مما إذا كان المستخدم مسؤولاً
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * التحقق مما إذا كان المستخدم مدير معرض
     *
     * @return bool
     */
    public function isShowroomManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * التحقق مما إذا كان المستخدم موظف مبيعات
     *
     * @return bool
     */
    public function isSalesEmployee(): bool
    {
        return $this->role === 'employee';
    }

    /**
     * التحقق مما إذا كان المستخدم عميلاً
     *
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    /**
     * الحصول على المعرف الذي سيتم تخزينه في رمز JWT
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * إرجاع المطالبات المخصصة الرئيسية لإضافتها إلى رمز JWT
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'role' => $this->role
        ];
    }



    
}
