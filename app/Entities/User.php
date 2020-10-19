<?php

namespace App\Entities;

use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User
 * @package App
 *
 * @property string $name
 * @property string media_token
 * @property string email
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles, HasFactory;

    protected $appends = ['avatar'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getAvatarAttribute()
    {
        return Gravatar::get($this->attributes['email']);
    }

    /**
     * @return HasMany
     */
    public function courses() : HasMany
    {
        return $this->hasMany(Course::class);
    }
}
