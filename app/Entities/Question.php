<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @property int $id
 * 
 * @property string $name
 * @property string $reference
 * 
 * @property HasMany|Symptom[] symptoms
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class Question extends Model
{
    protected $guarded = [];

    /**
     * @return HasMany|Symptom[]
     */
    public function symptoms()
    {
        return $this->hasMany(Symptom::class);
    }
}
