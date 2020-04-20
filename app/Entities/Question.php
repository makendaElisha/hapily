<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = []; //Change to fillable

    // public function customer()
    // {
    //     return $this->belongsTo('App\Entities\Customer');
    // }

    public function symptoms()
    {
        return $this->hasMany('App\Entities\Symptom');
    }
}
