<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['name', 'code', 'icon', 'description', 'published', 'user_id'];
    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function classroom_members()
    {
        return $this->hasMany('App\ClassroomMember');
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = htmlspecialchars($value);
    }
}
