<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Payment
 *
 * @property int $id
 * @property int $customer_id
 * 
 * @property decimal $transaction_amount
 * 
 * @property date $order_date
 * 
 * @property string $payment_type
 * @property string $payment_method
 * @property string $product_name
 * @property string $buyer_email
 * @property string $buyer_first_name
 * @property string $buyer_last_name
 * 
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class Payment extends Model
{

    protected $guarded = [];

}
