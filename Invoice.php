<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Models\System\Traits\HasInvoiceItems;
use App\Models\Shared\Model;

/**
 * Invoice Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Invoice extends Model implements HasMedia, Searchable
{
    use HasMediaTrait;
    use HasInvoiceItems;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'invoices';

    /**
     * @var string PAST_DUE
     */
    const PAST_DUE = 'past_due';

    /**
     * @var string UNPAID
     */
    const UNPAID = 'unpaid';

    /**
     * @var string PAID
     */
    const PAID = 'paid';

    /**
     * @var string VOID
     */
    const VOID = 'void';

    /**
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::UNPAID,
        self::PAST_DUE,
        self::PAID,
        self::VOID,
    ];

    /**
     * @var PARTIAL_PAYMENTS_ACCEPTED
     */
    const PARTIAL_PAYMENTS_ACCEPTED = 'true';

    /**
     * @var PARTIAL_PAYMENTS_NOT_ACCEPTED
     */
    const PARTIAL_PAYMENTS_NOT_ACCEPTED = 'false';

    /**
     * @var array PARTIAL_PAYMENTS_TYPES
     */
    const PARTIAL_PAYMENTS_TYPES = [
        self::PARTIAL_PAYMENTS_NOT_ACCEPTED,
        self::PARTIAL_PAYMENTS_ACCEPTED
    ];

    /**
     * Resized Images
     *
     * @param  Media $media
     * @return void
     * @access public
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10)
            ->keepOriginalImageFormat()
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(800)
            ->height(800)
            ->sharpen(10)
            ->keepOriginalImageFormat()
            ->nonQueued();
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
            $this->reference,
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
        'id'                    => 'integer',
        'uuid'                  => 'uuid',
        'type'                  => 'type',
        'reference'             => 'string',
        'billing_company'       => 'string',
        'billing_first_name'    => 'string',
        'billing_last_name'     => 'string',
        'billing_address'       => 'string',
        'billing_address_2'     => 'string',
        'billing_city'          => 'string',
        'billing_state'         => 'string',
        'billing_country'       => 'string',
        'billing_phone'         => 'string',
        'billing_mobile_phone'  => 'string',
        'billing_fax_number'    => 'string',
        'shipping_company'      => 'string',
        'shipping_first_name'   => 'string',
        'shipping_last_name'    => 'string',
        'shipping_address'      => 'string',
        'shipping_address_2'    => 'string',
        'shipping_city'         => 'string',
        'shipping_state'        => 'string',
        'shipping_country'      => 'string',
        'shipping_phone'        => 'string',
        'shipping_mobile_phone' => 'string',
        'shipping_fax_number'   => 'string',
        'payment_terms'         => 'string',
        'subtotal'              => 'integer',
        'taxes'                 => 'integer',
        'total'                 => 'integer',
        'due'                   => 'integer',
        'paid'                  => 'integer',
        'notes'                 => 'string',
        'terms'                 => 'string',
        'status'                => 'string',
        'meta_fields'           => 'array',
        'due_at'                => 'datetime',
        'paid_at'               => 'datetime',
        'voided_at'             => 'datetime',
        'created_at'            => 'datetime',
        'updated_at'            => 'datetime',
        'deleted_at'            => 'datetime'
    ];
}
