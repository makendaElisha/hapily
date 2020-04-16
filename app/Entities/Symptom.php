<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $guarded = []; //Change to fillable

    
    public function areaOfLife()
    {
        return $this->belongsTo(AreaOfLife::class);
    }

    public function customer()
    {
        return $this->belongsTo('App\Entities\Customer');
    }

    public function question()
    {
        return $this->belongsTo('App\Entities\Question');
    }
}
