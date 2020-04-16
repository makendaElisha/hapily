<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AreaOfLife extends Model
{
    protected $guarded = []; //Change to fillable

    
    public function symptoms()
    {
        return $this->hasMany(Symptom::class);
    }

    public function mapping()
    {
        return $this->belongsTo(Mapping::class);
    }
}
