<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarEngine extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'car_engine';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'engine_id';

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
        'car_id',
        'engine_name',
        'engine_capacity',
        'tranmission_type',
        'fuel_type',
        'fuel_tank_capacity',
        'max_speed',
        'acceleration',
        'breaking_distance',
        'max_power',
        'max_torque',
        'displacement',
        'number_cylinders',
        'valves_of_cylinders',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'engine_capacity' => 'decimal:1',
        'fuel_tank_capacity' => 'decimal:2',
        'max_speed' => 'integer',
        'acceleration' => 'decimal:2',
        'breaking_distance' => 'decimal:2',
        'max_power' => 'decimal:2',
        'max_torque' => 'decimal:2',
        'displacement' => 'decimal:1',
        'number_cylinders' => 'integer',
        'valves_of_cylinders' => 'integer',
    ];

    /**
     * الحصول على السيارة المرتبطة بهذا المحرك
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}
