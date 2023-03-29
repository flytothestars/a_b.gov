<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use HasRoles, AuthenticationLoggable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'telegram_user_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accessTokens()
    {
        return $this->hasMany('App\Models\OauthAccessToken');
    }

    public function getAccessTokenAttribute()
    {
        if($this->accessTokens())
            $this->accessTokens()->delete();

        $roles = $this->getRoleNames();
        return $this->createToken('authToken', $roles->toArray())->accessToken;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function appeals()
    {
        return $this->hasMany(Appeal::class, 'user_id', 'id');
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, '');
    }




}
