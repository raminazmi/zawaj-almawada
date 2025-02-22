<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessActivity extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'activity_type',
        'state',
        'offers_rewards'
    ];

    protected $casts = [
        'offers_rewards' => 'boolean'
    ];

    public const ACTIVITY_TYPES = [
        'محلات تأجير الخيام',
        'محلات تأجير القاعات',
        'محلات الأثاث',
        'مستلزمات الأعراس',
        'محلات التصميم والتصوير',
        'مطاعم تقديم الولائم'
    ];

    public const STATUSES = [
        'مقبول',
        'مرفوض',
        'قيد الانتظار'
    ];
}
