<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}
