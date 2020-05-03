<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 *
 * @property int $id
 * @property int $customer_id
 * @property int $question_id
 * 
 * @property string $name
 * @property string $reference
 * 
 * @property BelongsTo|Customer customer
 * @property BelongsTo|Question question
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class Answer extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo|Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo|Question
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
