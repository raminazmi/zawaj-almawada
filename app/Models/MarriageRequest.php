<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarriageRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'target_user_id',
        'request_number',
        'applicant_type',
        'status',
        'compatibility_test_link',
        'compatibility_test_result',
        'test_link_sent',
        'admin_approval_status',
        'exam_id',
    ];

    protected $attributes = [
        'compatibility_test_link' => null,
    ];

    protected $casts = [
        'test_link_sent' => 'boolean',
        'admin_approval_status' => 'string',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
        'deleted_at' => 'datetime:Y-m-d H:i',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['compatibility_test_link'] = route('exam.pledge');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }
}
