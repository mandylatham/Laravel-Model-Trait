<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\System\Traits\HasCalendarEvents;
use App\Models\System\Traits\HasUsers;
use App\Models\System\Traits\HasOffices;
use App\Models\Shared\Model;

/**
 * Appointment Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Appointment extends Model
{
    use HasCalendarEvents;
    use HasUsers;
    use HasOffices;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'appointments';

    /**
     * @var string CREATED
     */
    const CREATED = 'created';

    /**
     * @var string PENDING
     */
    const PENDING = 'pending';

    /**
     * @var string CANCELED
     */
    const CANCELED = 'canceled';

    /**
     * @var string SCHEDULED
     */
    const SCHEDULED = 'scheduled';

    /**
     * @var string RESCHEDULED
     */
    const RESCHEDULED = 'rescheduled';

    /**
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::CREATED,
        self::PENDING,
        self::CANCELED,
        self::SCHEDULED,
        self::RESCHEDULED
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'description',
        'status',
        'meta_fields',
        'scheduled_on',
        'previous_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array $casts Type casting field columns before interting to database.
     */
    protected $casts = [
        'id'            => 'integer',
        'uuid'          => 'string',
        'reference'     => 'string',
        'description'   => 'string',
        'status'        => 'string',
        'meta_fields'   => 'array',
        'scheduled_on'  => 'datetime',
        'scheduled_end'  => 'datetime',
        'previous_date' => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
