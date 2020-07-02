<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Matery extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;
    protected $fillable = ['course_id', 'title', 'video_url', 'duration', 'audio_url', 'article_url', 'article'];
    protected $hidden = ['id', 'course_id'];

    public function setArticleAttribute($value)
    {
        $this->attributes['article'] = htmlspecialchars($value);
    }

    public function getArticleAttribute($value)
    {
        return htmlspecialchars_decode($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function member_materies()
    {
        return $this->hasMany('App\MemberMatery');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Quiz', 'parent_id')->where('parent', 'materies');
    }
}
