<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'visit_id';

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
        'showroom_id',
        'customer_id',
        'visit_date',
        'notes',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'visit_date' => 'datetime',
    ];

    /**
     * الحصول على المعرض المرتبط بهذه الزيارة
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function showroom(): BelongsTo
    {
        return $this->belongsTo(Showroom::class, 'showroom_id', 'showroom_id');
    }

    /**
     * الحصول على العميل المرتبط بهذه الزيارة
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
