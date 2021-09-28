<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @property int $id
 * @property int $postal_code
 * 
 * @property boolean $call_opt_in
 * @property boolean $newsletter_opt_in
 * 
 * @property date $birth
 * 
 * @property string $prename
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property string $time_invest_willingness
 * @property string $money_invest_willingness
 * @property string $phone_number
 * @property string $network_id
 * @property string $submit_date
 * @property string $start_date
 * @property string $survey_url
 * @property string $token
 * 
 * @property HasMany|Survey[] surveys
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class Customer extends Model
{
    protected $guarded = [];

    /**
     * @return HasMany|Survey[]
     */
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    /**
     * @return HasOne|Feedback[]
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
