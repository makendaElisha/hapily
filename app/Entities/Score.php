<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Score
 *
 * @property int $id
 * @property int $customer_id
 * 
 * @property float $beruf_und_karriere
 * @property float $partnerschaft
 * @property float $sexualitaet
 * @property float $koerper_und_gesundheit
 * @property float $freundschaften
 * @property float $familie
 * @property float $spiritualitaet
 * @property float $total_areas
 * 
 * @property BelongsTo|Customer customer
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class Score extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo|Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
