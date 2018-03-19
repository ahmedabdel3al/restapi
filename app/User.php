<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use softDeletes;
    protected $dates=['delete_at'];
    public const verified = '1';
    public const unverified = '0';
    public const admin = 'true';
    public const requar_user = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'admin', 'verification_token'
    ];
    protected $table = 'users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        //'verification_token'
    ];

    public function isVerified()
    {
        return $this->verified == User::verified;
    }

    public function isAdmin()
    {
        return $this->admin == User::admin;
    }

    public static function generateVerificationCode()
    {
        return str_random(20);
    }

}
