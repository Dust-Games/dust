<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Session;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public const MAX_TOKENS_COUNT = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPassword()
    {
        return $this->getAttributeFromArray('password');
    }

    public function hasTooManyTokens()
    {
        return $this->tokens()->count() >= static::MAX_TOKENS_COUNT;
    }
}
