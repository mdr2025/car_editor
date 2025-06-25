<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Login extends Model
{
    use HasFactory;

    /**
     * اسم الجدول المرتبط بالنموذج
     *
     * @var string
     */
    protected $table = 'login';

    /**
     * المفتاح الأساسي للجدول
     *
     * @var string
     */
    protected $primaryKey = 'login_id';

    /**
     * الحقول القابلة للتعبئة الجماعية
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'username',
        'password',
    ];

    /**
     * الحقول التي يجب إخفاؤها في المصفوفات
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * تحويل الحقول إلى أنواع البيانات المناسبة
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * علاقة مع المستخدم
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
