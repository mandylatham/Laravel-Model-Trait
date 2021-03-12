<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Traits\HasStates;

/**
 * Countries Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Country extends Model
{
    use HasStates;
    use SoftDeletes;

    /**
     * Database table for model
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'countries';

    /**
     * Status Active
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Status Active
     *
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * Status types
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
     * @var    array Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'code'          => 'string',
        'name'          => 'string',
        'status'        => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime'
    ];
}
