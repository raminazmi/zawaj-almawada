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
        'status'
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
        ];
    }

    public function activeMarriageRequest()
    {
        return $this->hasOne(MarriageRequest::class, 'user_id')
            ->whereIn('status', ['pending', 'approved', 'engaged', 'rejected'])
            ->first();
    }

    public function targetMarriageRequest()
    {
        return $this->hasOne(MarriageRequest::class, 'target_user_id')
            ->whereIn('status', ['pending', 'approved', 'engaged', 'rejected'])
            ->first();
    }
}
