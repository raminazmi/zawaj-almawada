<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarriageRequest extends Model
{
    protected $fillable = [
        'user_id',
        'target_user_id',
        'status',
        'request_number',
        'applicant_type',
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
        'housing_type',
        'health_status',
        'has_disability',
        'disability_details',
        'has_deformity',
        'deformity_details',
        'wants_children',
        'infertility',
        'is_smoker',
        'religiosity_level',
        'prayer_commitment',
        'personal_description',
        'partner_expectations'
    ];

    protected $casts = [
        'has_children' => 'boolean',
        'has_disability' => 'boolean',
        'has_deformity' => 'boolean',
        'wants_children' => 'boolean',
        'infertility' => 'boolean',
        'is_smoker' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
