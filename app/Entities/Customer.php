<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = []; //Change to fillable

    
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
}
