<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = []; //Change to Fillable

    public function customer()
    {
        return $this->belongsTo('App\Entities\Customer');
    }

    // public function question()
    // {
    //     return $this->belongsTo('App\Entities\Question');
    // }

    public function Mapping()
    {
        return $this->hasOne('App\Mapping', 'symptom_title', 'title');
    }
}
