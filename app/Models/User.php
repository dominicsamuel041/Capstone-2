<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
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
        'role_id',
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

    /**
     * Relationship with Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Role checking helpers
    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'Admin';
    }

    public function isKalab(): bool
    {
        return $this->role && $this->role->name === 'Kalab';
    }

    public function isKaprodi(): bool
    {
        return $this->role && $this->role->name === 'Kaprodi';
    }

    public function isAdminStaf(): bool
    {
        return $this->role && $this->role->name === 'Admin_Staf';
    }

    public function isLabStaf(): bool
    {
        return $this->role && $this->role->name === 'Lab_Staf';
    }
}
