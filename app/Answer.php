<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTrait;
    
    protected $fillable=['body','user_id'];

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getBodyHtmlAttribute(){
        return clean(\Parsedown::instance()->text($this->body));
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public static function boot(){
        parent::boot();

        static::created(function($answer){
            $answer->question->increment('answers_count');
        });

        static::deleted(function($answer){
            $question= $answer->question;
            $question->decrement('answers_count');
        });
    }

    public function getStatusAttribute(){
        return $this->id == $this->question->best_answer_id ? 'vote-accepted' : '';
    }
    
    public function getIsBestAttribute()
    {
        return $this->id == $this->question->best_answer_id;
    }




}
