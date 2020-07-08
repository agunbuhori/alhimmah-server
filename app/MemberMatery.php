<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberMatery extends Model
{
    protected $hidden = ['user_id', 'matery_id', 'quiz_corrections'];
    public function matery()
    {
        return $this->belongsTo('App\Matery');
    }
}
