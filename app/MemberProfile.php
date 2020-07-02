<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    public $timestamps = false;

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
