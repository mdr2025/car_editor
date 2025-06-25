<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'customer_id';

    /**
     * تعطيل الطوابع الزمنية
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * الخصائص التي يمكن تعيينها بشكل جماعي
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'address',
        'birth_date',
        'gender',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * الحصول على المستخدم المرتبط بهذا العميل
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * الحصول على الحسابات البنكية المرتبطة بهذا العميل
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(CustomerBankAccount::class, 'customer_id', 'customer_id');
    }

    /**
     * الحصول على عمليات البيع المرتبطة بهذا العميل
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'customer_id', 'customer_id');
    }

    /**
     * الحصول على الزيارات المرتبطة بهذا العميل
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'customer_id', 'customer_id');
    }
}
