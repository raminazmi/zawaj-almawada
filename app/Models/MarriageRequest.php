<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarriageRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'applicant_type',
        'request_number',
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
        'religiosity_level',
        'prayer_commitment',
        'personal_description',
        'partner_expectations',
        'status',
        'target_user_id'
    ];

    protected $casts = [
        'has_children' => 'boolean',
        'has_disability' => 'boolean',
        'has_deformity' => 'boolean',
        'wants_children' => 'boolean',
        'infertility' => 'boolean',
        'monthly_income' => 'decimal:2',
    ];
}
