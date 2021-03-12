<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Currency Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Currency extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'currencies';

    /**
     * Currency active status
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Currency inactive status
     *
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * Status Types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::INACTIVE
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'symbol'            => 'string',
        'name'              => 'string',
        'name_plural'       => 'string',
        'symbol_native'     => 'string',
        'decimal_digits'    => 'integer',
        'status'            => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime'
    ];
}
