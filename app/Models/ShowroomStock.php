<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShowroomStock extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'showroom_stock';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = null;

    /**
     * تعطيل الطوابع الزمنية
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * تعيين المفتاح الأساسي كمركب
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * الخصائص التي يمكن تعيينها بشكل جماعي
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'showroom_id',
        'inventory_id',
        'quantity',
        'last_delivery_date',
        'status',
        'notes',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'last_delivery_date' => 'date',
    ];

    /**
     * الحصول على المعرض المرتبط بهذا المخزون
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function showroom(): BelongsTo
    {
        return $this->belongsTo(Showroom::class, 'showroom_id', 'showroom_id');
    }

    /**
     * الحصول على المخزون المرتبط بهذا المخزون
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(CarInventory::class, 'inventory_id', 'inventory_id');
    }
}
