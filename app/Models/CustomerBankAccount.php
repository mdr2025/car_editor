<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerBankAccount extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'customer_bank_accounts';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'account_id';

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
        'bank_name',
        'account_number',
        'account_holder_name',
        'iban',
    ];

    /**
     * الحصول على العميل المرتبط بهذا الحساب البنكي
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
