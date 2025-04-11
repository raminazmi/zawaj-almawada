<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'gender',
        'country',
        'phone',
        'age',
        'height',
        'weight',
        'skin_color',
        'status',
        'is_admin',
        'state',
        'tribe',
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
        'partner_expectations',
        'profile_status',
        'membership_number',
        'full_name',
        'village',
        'admin_role',
        'legal_agreement',
        'is_hijabi',
        'is_active',
        'email_verified_at',
        'accepts_married',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'has_children' => 'boolean',
            'has_disability' => 'boolean',
            'has_deformity' => 'boolean',
            'wants_children' => 'boolean',
            'infertility' => 'boolean',
            'is_smoker' => 'boolean',
            'is_hijabi' => 'boolean',
            'accepts_married' => 'boolean',
        ];
    }

    public function activeMarriageRequest()
    {
        return $this->hasOne(MarriageRequest::class, 'user_id')
            ->whereIn('status', ['pending', 'approved', 'engaged']);
    }

    public function targetMarriageRequest()
    {
        return $this->hasOne(MarriageRequest::class, 'target_user_id')
            ->whereIn('status', ['pending', 'approved', 'engaged']);
    }

    public function submittedRequests()
    {
        return $this->hasMany(MarriageRequest::class, 'user_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(MarriageRequest::class, 'target_user_id');
    }

    public function exams(): HasMany
    {
        $foreignKey = auth()->user()->gender . '_user_id';
        return $this->hasMany(Exam::class, $foreignKey);
    }

    public function activeExam()
    {
        if (!auth()->user()->gender) {
            return null;
        }
        return $this->exams()->where(auth()->user()->gender . '_finished', false)->first();
    }

    public function marriageRequests()
    {
        return $this->hasMany(MarriageRequest::class, 'user_id');
    }

    public function isProfileApproved(): bool
    {
        return $this->profile_status === 'approved';
    }

    public function isMainAdmin(): bool
    {
        return $this->is_admin && $this->admin_role === 'main';
    }

    public function isSubAdmin(): bool
    {
        return $this->is_admin && $this->admin_role === 'sub';
    }
}
