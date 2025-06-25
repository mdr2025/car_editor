<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'sales';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'sale_id';

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
        'customer_id',
        'car_id',
        'employee_id',
        'payment_method',
        'sale_date',
        'total_price',
        'tax',
        'notes',
    ];

    /**
     * الخصائص التي يجب تحويلها
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sale_date' => 'datetime',
        'total_price' => 'decimal:2',
        'tax' => 'decimal:2',
    ];

    /**
     * الحصول على العميل المرتبط بعملية البيع
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    /**
     * الحصول على السيارة المرتبطة بعملية البيع
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }

    /**
     * الحصول على الموظف المرتبط بعملية البيع
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
