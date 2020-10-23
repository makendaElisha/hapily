<?php

namespace App\Entities;

use App\Entities\Customer;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'token', 'option1', 'option2', 'option3', 'option4', 'option5', 'option6'
    ];

    public function customer()
    {
        $this->belongsTo(Customer::class);
    }
}
