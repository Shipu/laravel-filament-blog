<?php

namespace App\Models;

use Filament\Models\Concerns\IsFilamentUser;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, IsFilamentUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'status',
        'email',
        'avatar',
        'roles',
        'is_admin',
        'is_teammate',
        'password',
    ];

    public static $filamentAdminColumn = 'is_admin';

    public static $filamentUserColumn = 'is_teammate';

    public static $filamentAvatarColumn = 'avatar';

    public static $filamentRolesColumn = 'roles';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'bool',
        'roles' => 'array',
    ];

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
