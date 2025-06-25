<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showroom extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'showrooms';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'showroom_id';

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
        'showroom_name',
        'location',
        'showroom_phone',
        'showroom_email',
        'working_hour',
        'showroom_status',
        'website_url',
        'image_path',
    ];

    /**
     * الحصول على مخزون السيارات المرتبط بهذا المعرض
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carInventories(): HasMany
    {
        return $this->hasMany(CarInventory::class, 'showroom_id', 'showroom_id');
    }

    /**
     * الحصول على الموظفين المرتبطين بهذا المعرض
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'showroom_id', 'showroom_id');
    }

    /**
     * الحصول على الوظائف المرتبطة بهذا المعرض
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'showroom_id', 'showroom_id');
    }

    /**
     * الحصول على الزيارات المرتبطة بهذا المعرض
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'showroom_id', 'showroom_id');
    }

    /**
     * الحصول على مخزون المعرض المرتبط بهذا المعرض
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function showroomStocks(): HasMany
    {
        return $this->hasMany(ShowroomStock::class, 'showroom_id', 'showroom_id');
    }
}
