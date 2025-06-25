<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'job';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'job_id';

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
        'employee_id',
        'showroom_id',
        'start_date',
        'end_date',
        'working_status',
        'notes',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * الحصول على الموظف المرتبط بهذه الوظيفة
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * الحصول على المعرض المرتبط بهذه الوظيفة
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function showroom(): BelongsTo
    {
        return $this->belongsTo(Showroom::class, 'showroom_id', 'showroom_id');
    }
}
