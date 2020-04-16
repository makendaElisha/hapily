<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    protected $guarded = []; //Change to fillable

    public function areaOfLives()
    {
        return $this->hasMany(AreaOfLife::class);
    }
}
