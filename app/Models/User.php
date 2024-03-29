<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'login_date',



    ];

    public function donations()
    {
        return $this->hasMany(Donation ::class,'user_id');
    }
    public function applicants()
    {
        return $this->hasMany(Applicant ::class,'user_id');
    }


    public function challs()
    {
        return $this->hasMany(Chall::class,'user_id');
    }

    public function requests()
    {
        return $this->hasOne(Req::class,'user_id');
    }
//
//    public function requests()
//    {
//        return $this->hasOne('App\Model\Req');
//    }

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
