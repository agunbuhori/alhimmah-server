<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberMatery extends Model
{
    protected $hidden = ['user_id', 'matery_id'];
    public function matery()
    {
        return $this->belongsTo('App\Matery');
    }
}
