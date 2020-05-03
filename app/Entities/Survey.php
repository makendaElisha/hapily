<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

//Not being used for the moment. 
class Survey extends Model
{
    protected $guarded = []; //Change to fillable

    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
