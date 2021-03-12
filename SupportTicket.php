<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasMessages;
use App\Models\Shared\Model;

/**
 * Support Tickets Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class SupportTicket extends Model implements Searchable
{
    use HasMessages;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'support_tickets';

    /**
     * Status Created
     *
     * @var string CREATED
     */
    const CREATED = 'created';

    /**
     * Status Open
     *
     * @var string OPEN
     */
    const OPEN = 'open';

    /**
     * Status Closed
     *
     * @var string CLOSED
     */
    const CLOSED = 'closed';

    /**
     * Status Types
     */
    const STATUS_TYPES = [
        self::CREATED,
        self::OPEN,
        self::CLOSED
    ];

    /**
     * Priority Status Low
     *
     * @var string PRIORITY_LOW
     */
    const PRIORITY_LOW = 'low';

    /**
     * Priority Status High
     *
     * @var string PRIORITY_HIGH
     */
    const PRIORITY_HIGH = 'high';

    /**
     * Priority Status Critical
     *
     * @var string PRIORITY_CRITICAL
     */
    const PRIORITY_CRITICAL = 'critical';

    /**
     * Priority Status Levels
     *
     * @var array PRIORITY_LEVELS
     */
    const PRIORITY_LEVELS = [
        self::PRIORITY_LOW,
        self::PRIORITY_HIGH,
        self::PRIORITY_CRITICAL
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
        'priority'          => 'string',
        'type'              => 'string',
        'reference'         => 'string',
        'status'            => 'string',
        'meta_fields'       => 'array',
        'date_closed_at'    => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime'
    ];
}
