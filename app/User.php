<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','reason','api_token'
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
    // 毎回記述しなくてもいいように定義しておく
    protected $withCount = ['messages'];

    protected $with = ['messages'];

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public static function getUserList()
    {
        return static::latest()->pluck('name', 'id');
    }


    // イベント登録 deleting （実際に削除する前に呼ばれる）
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->messages()->delete();
        });
    }
}
