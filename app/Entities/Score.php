<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $guarded = []; //Change to fillable

    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
