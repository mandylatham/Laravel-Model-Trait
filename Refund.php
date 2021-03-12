<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasComments;
use App\Models\Shared\Model;

/**
 * Payment Refunds Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Refund extends Model implements Searchable
{
    use HasComments;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'refunds';

    /**
     * Refund pending
     *
     * @var string PENDING
     */
    const PENDING = 'pending';

    /**
     * Refund failed
     *
     * @var string FAILED
     */
    const FAILED = 'failed';

    /**
     * Refund completed
     *
     * @var string COMPLETED
     */
    const COMPLETED = 'completed';

    /**
     * Status Types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::PENDING,
        self::FAILED,
        self::COMPLETED
    ];

    /**
     * @var string PARTIAL_AMOUNT
     */
    const PARTIAL_AMOUNT = 'partial';

    /**
     * @var string FULL_AMOUNT
     */
    const FULL_AMOUNT = 'full';

    /**
     * @var array REFUND_TYPES
     */
    const REFUND_TYPES = [
        self::PARTIAL_AMOUNT,
        self::FULL_AMOUNT
    ];

    /**
     * Status Email Sent
     *
     * @var string EMAIL_SENT
     */
    const EMAIL_SENT = 'true';

    /**
     * @var string EMAIL_NOT_SENT
     */
    const EMAIL_NOT_SENT = 'false';

    /**
     * @var array EMAIL_STATUS_TYPES
     */
    const EMAIL_STATUS_TYPES = [
        self::EMAIL_SENT,
        self::EMAIL_NOT_SENT
    ];

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
        'id'                => 'integer',
        'uuid'              => 'string',
        'refunded_by'       => 'string',
        'type'              => 'string',
        'reference'         => 'string',
        'string_response'   => 'object',
        'stripe_token'      => 'string',
        'payment_id'        => 'integer',
        'amount'            => 'integer',
        'comment'           => 'string',
        'status'            => 'string',
        'meta_fields'       => 'array',
        'email_sent'        => 'string',
        'refunded_at'       => 'datetime',
        'notified_at'       => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];
}
