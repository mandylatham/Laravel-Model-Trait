<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\System\Traits\HasCartLines;
use App\Models\Shared\Model;

/**
 * Carts Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Cart extends Model
{
    use HasCartLines;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'carts';

    /**
     * @var string CREATED
     */
    const CREATED = 'created';

    /**
     * @var string OPEN
     */
    const OPEN = 'open';

    /**
     *
     * @var string COMPLETED
     */
    const CLOSED = 'closed';

    /**
     * Status Types
     *
     * @var string STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::CREATED,
        self::OPEN,
        self::CLOSED
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'uuid'          => 'string',
        'subtotal'      => 'integer',
        'status'        => 'integer',
        'meta_fields'   => 'array',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
