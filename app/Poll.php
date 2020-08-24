<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function answers(){

        return $this->belongsToMany(Answer::class);
    }
}
