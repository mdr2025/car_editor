<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'employee_id';

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
        'showroom_id',
        'hire_date',
        'position',
        'salary',
        'department',
        'employee_status',
        'notes',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hire_date' => 'date',
        'salary' => 'decimal:2',
    ];

    /**
     * الحصول على المستخدم المرتبط بهذا الموظف
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * الحصول على المعرض المرتبط بهذا الموظف
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function showroom(): BelongsTo
    {
        return $this->belongsTo(Showroom::class, 'showroom_id', 'showroom_id');
    }

    /**
     * الحصول على عمليات البيع المرتبطة بهذا الموظف
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'employee_id', 'employee_id');
    }

    /**
     * الحصول على الوظائف المرتبطة بهذا الموظف
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'employee_id', 'employee_id');
    }
}
