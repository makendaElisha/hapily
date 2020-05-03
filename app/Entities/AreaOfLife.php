<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AreaOfLife
 *
 * @property int $id
 * @property string $name
 * 
 * @property HasMany|Symptom[] symptoms
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class AreaOfLife extends Model
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
