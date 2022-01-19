<?php

namespace Nrz\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Nrz\Post\Models\Post;
use Nrz\Post\Models\PostLike;
use Nrz\User\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static $defaultUsers = [
        [
            'email' => 'abol@gmail.com',
            'password' => 'password',
            'name' => 'ابوالفضل نورزاد',
            'isAdmin' => true,

        ],
        [
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'name' => 'ادمین ',
            'isAdmin' => true,
        ],

    ];

    public function sendPasswordResetNotification($token)
    {
        $url = env('APP_URL') . "?token=" . $token;
        $this->notify(new ResetPasswordNotification($url));
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }
}
