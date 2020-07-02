<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function matery()
    {
        return $this->belongsTo('App\Matery', 'parent_id');
    }
}
