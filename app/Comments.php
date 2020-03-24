<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $guarded = [];

    public function message(){
      return $this->belongsTo('App\Message');
    }
}
