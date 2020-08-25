<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'url',
    ];

    public function answers(){

        return $this->belongsToMany(Answer::class);
    }
}
