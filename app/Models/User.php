<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Roles available in the system
     */
    public const ROLES = [
        'admin' => 'Administrator',
        'editor' => 'Editor',
        'viewer' => 'Viewer',
        // Add more roles as needed
    ];
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'role',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Default role for new users
     */
    protected $attributes = [
        'role' => 'viewer',
    ];

    /**
     * Check if user has admin role
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Scope for filtering by role
     */
    public function scopeWithRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Get the user's full name
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
