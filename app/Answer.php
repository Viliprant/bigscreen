<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'libelle',
        'question_id',
        'poll_id',
    ];
    public $timestamps = false;

    public function question(){

        return $this->belongsTo(Question::class);
    }
    public function poll(){

        return $this->belongsTo(Poll::class);
    }
}
