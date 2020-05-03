<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Symptom
 *
 * @property int $id
 * @property int $area_of_life_id
 * @property int $res_prio
 * @property int $fear
 * @property int $anger
 * @property int $sadness
 * 
 * @property string $name
 * @property string $instant_help
 * @property string $belief
 * @property string $recom_book_url
 * @property string $recom_book_image
 * @property string $recom_book_description
 * @property string $recom_program_url
 * @property string $recom_program_image
 * @property string $recom_program_description
 * 
 * @property BelongsTo|AreaOfLife areaOfLife
 * @property BelongsTo|Customer customer
 * @property BelongsTo|Question question
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class Symptom extends Model
{
    protected $guarded = []; //Change to fillable

    /**
     * @return BelongsTo|AreaOfLife
     */    
    public function areaOfLife()
    {
        return $this->belongsTo(AreaOfLife::class);
    }

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
