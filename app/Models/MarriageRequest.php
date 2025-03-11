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
        'admin_approval_status',
        'state',
        'age',
        'height',
        'weight',
        'tribe',
        'skin_color',
        'lineage',
        'marital_status',
        'has_children',
        'children_count',
        'education_level',
        'work_sector',
        'job_title',
        'monthly_income',
        'religion',
        'genetic_diseases',
        'infectious_diseases',
        'psychological_disorders',
        'compatibility_test_link',
        'compatibility_test_result',
        'test_link_sent',
        'housing_type',
        'health_status',
        'has_disability',
        'disability_details',
        'has_deformity',
        'deformity_details',
        'wants_children',
        'infertility',
        'is_smoker',
        'real_name',
        'village',
        'religiosity_level',
        'prayer_commitment',
        'personal_description',
        'partner_expectations',
    ];

    protected $casts = [
        'has_children' => 'boolean',
        'has_disability' => 'boolean',
        'has_deformity' => 'boolean',
        'wants_children' => 'boolean',
        'infertility' => 'boolean',
        'is_smoker' => 'boolean',
        'admin_approval_status' => 'string',
        'test_link_sent' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
        'deleted_at' => 'datetime:Y-m-d H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
