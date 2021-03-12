<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Time Zone Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class TimeZone extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'timezones';

    /**
     * @var DEFAULT_TZ Default Time Zone
     */
    const DEFAULT_TZ = 'America/Los_Angeles';

    /**
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';


    /**
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
        'zone'              => 'string',
        'status'            => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime'
    ];
}
