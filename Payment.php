<?php

declare(strict_types=1);

namespace App\Models\System;

use Stripe\Stripe as Stripe;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\CardException;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\User;
use App\Models\Shared\Model;

/**
 * Payments Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Payment extends Model implements Searchable
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'payments';

    /**
     * Default Currency Code
     *
     * @var string DEFAULT_CURRENCY_CODE
     */
    const DEFAULT_CURRENCY_CODE = 'usd';

    /**
     * Unpaid Status
     *
     * @var string UNPAID
     */
    const UNPAID = 'unpaid';

    /**
     * Paid Status
     *
     * @var string STATUS_PAID
     */
    const PAID = 'paid';

    /**
     * Payment status
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::PAID,
        self::UNPAID
    ];

    /**
     * Email sent status
     *
     * @var string EMAIL_SENT
     */
    const EMAIL_SENT = 'true';

    /**
     * Email not sent status
     *
     * @var string EMAIL_NOT_SENT
     */
    const EMAIL_NOT_SENT = 'false';

    /**
     * Email status types
     *
     * @var array EMAIL_STATUS_TYPES
     */
    const EMAIL_STATUS_TYPES = [
        self::EMAIL_SENT,
        self::EMAIL_NOT_SENT
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid',
        'stripe_response',
        'stripe_customer',
        'stripe_token'
    ];

    /**
     * Get stripe customer payment method card
     *
     * @param  string $payment_method
     * @param  string $stripe_error
     * @return \Stripe\PaymentMethod|null
     */
    public static function getStripePaymentMethod(string $payment_method, string &$stripe_error): ?\Stripe\PaymentMethod
    {
        if (filled($payment_method)) {
            $json = false;
            $error = false;

            // Set Stripe Key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $payment_method = \Stripe\PaymentMethod::retrieve($payment_method);
            } catch (InvalidRequestException $e) {
                $json = json_decode(json_encode($e->getJsonBody()), false);
                $error = $json->error;
                $stripe_error = $error->message;
                logger($stripe_error);
            }

            if (!filled($stripe_error)) {
                return $payment_method;
            }
        }

        return null;
    }

    /**
     * Returns search sesults
     *
     * @return \Spatie\Searchable\SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            ($this->first_name . ' ' . $this->last_name . ' (' . $this->email . ')'),
            null,
        );
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'                => 'integer',
        'uuid'              => 'string',
        'type'              => 'string',
        'reference'         => 'string',
        'first_name'        => 'string',
        'last_name'         => 'string',
        'address'           => 'string',
        'address_2'         => 'string',
        'city'              => 'string',
        'state'             => 'string',
        'zipcode'           => 'string',
        'country'           => 'string',
        'status'            => 'string',
        'meta_fields'       => 'array',
        'amount'            => 'integer',
        'charged'           => 'integer',
        'paid'              => 'integer',
        'due'               => 'integer',
        'currency'          => 'string',
        'card_brand'        => 'string',
        'card_full_name'    => 'string',
        'last_four_digits'  => 'integer',
        'exp_month'         => 'integer',
        'exp_year'          => 'integer',
        'cvc'               => 'integer',
        'stripe_response'   => 'object',
        'stripe_customer'   => 'string',
        'stripe_token'      => 'string',
        'email_sent'        => 'string',
        'user_agent'        => 'string',
        'ip_address'        => 'string',
        'paid_at'           => 'datetime',
        'declined_at'       => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime'
    ];
}
