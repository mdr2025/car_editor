<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{

    //تمت اضافة هذه الجزئية
    
    public function getRouteKeyName()
{
    return 'car_id';
}

    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'cars';
    

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'car_id';

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
        'inventory_id',
        'car_name',
        'model_year',
        'color',
        'vin',
        'seats',
        'price',
        'image_path_url',
        'wheels',
        'tires',
        'overall_length',
        'overall_width',
        'overall_height',
        'wheel_base',
        'front_wheel_tread',
        'rear_wheel_tread',
        'lightest_curb_weight',
        'heaviest_curb_weight',
        'gross_curb_weight',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'model_year' => 'integer',
        'price' => 'integer',
        'overall_length' => 'decimal:2',
        'overall_width' => 'decimal:2',
        'overall_height' => 'decimal:2',
        'wheel_base' => 'decimal:2',
        'front_wheel_tread' => 'decimal:2',
        'rear_wheel_tread' => 'decimal:2',
        'lightest_curb_weight' => 'decimal:2',
        'heaviest_curb_weight' => 'decimal:2',
        'gross_curb_weight' => 'decimal:2',
    ];

    /**
     * الحصول على محرك السيارة المرتبط بهذه السيارة
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function engine(): HasOne
    {
        return $this->hasOne(CarEngine::class, 'car_id', 'car_id');
    }
    

    /**
     * الحصول على المخزون المرتبط بهذه السيارة
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(CarInventory::class, 'inventory_id', 'inventory_id');
    }

    /**
     * الحصول على عملية البيع المرتبطة بهذه السيارة
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class, 'car_id', 'car_id');
    }
}
