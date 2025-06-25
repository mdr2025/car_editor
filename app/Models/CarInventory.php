<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarInventory extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'car_inventory';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'inventory_id';

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
        'quantity',
        'available_status',
        'notes',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
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
     * الحصول على السيارات المرتبطة بهذا المخزون
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'inventory_id', 'inventory_id');
    }

    /**
     * الحصول على مخزون المعارض المرتبط بهذا المخزون
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showroomStocks(): HasMany
    {
        return $this->hasMany(ShowroomStock::class, 'inventory_id', 'inventory_id');
    }
}
