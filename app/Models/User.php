<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone_number',
        'picture',
        'email',
        'email_verified_at',
        'password',
        'last_online',
        'verification_code',
        'new_email',
        'status',
        'first',
        'last_accept_date',
        'created',
        'modified',
        'company_contact',
        'credits',
        'first_trip',
        'incomplete_profile',
        'phone_verify',
        'token_auto_login',
        'user_vertical',
        'language_id',
        'no_registered'
    ];

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
    ];

    public function userPlans()
    {
        return $this->hasOne('App\Models\UserPlans', 'user_id','id');
    }

}
