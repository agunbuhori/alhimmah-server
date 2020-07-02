<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'code', 'icon', 'description', 'published', 'classroom_id', 'teacher_id'];
    protected $hidden = ['id', 'classroom_id'];

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');

        
    }

    public function materies()
    {
        return $this->hasMany('App\Matery');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
