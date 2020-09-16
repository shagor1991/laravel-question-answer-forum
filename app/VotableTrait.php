<?php 
namespace App;

trait VotableTrait
{
    public function votes(){
        return $this->morphToMany('App\User','votable');
    }
}