<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'gender',
        'country',
        'phone',
        'current_marriage_request_id',
        'marital_status',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
        return $this->hasMany(MarriageRequest::class);
    }

    public function activeMarriageRequest()
    {
        return $this->hasOne(MarriageRequest::class, 'user_id')
            ->where('status', 'active');
    }
}
