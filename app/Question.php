<?php

namespace App;
use App\Answer;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use VotableTrait;
    protected $fillable= ['title','body'];
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function setTitleAttribute($value){
        $this->attributes['title']  =$value;
        $this->attributes['slug']   =str_slug($value);        
    }

    public function getUrlAttribute(){
        return route('question.show',$this->slug);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count >0){
            if($this->best_answer_id){
                return 'answered-accepted';
            }
            return 'answered';
        }

        return 'unanswered';
    }

    public function getBodyHtmlAttribute(){
        return clean(\Parsedown::instance()->text($this->body));
    }

    public function answers(){
        return $this->hasMany('App\Answer')->orderBy('votes_count','DESC');
    }

    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id= $answer->id;
        $this->save();
    }

    public function favorites(){
        return $this->belongsToMany('App\User','favorites')->withTimestamps();
    }

    public function getIsFavoritedAttribute(){
        return $this->favorites()->where('user_id',auth()->id())->count() > 0 ;
    }

    public function getFavoritesCountAttribute(){
        return $this->favorites->count();
    }


}
