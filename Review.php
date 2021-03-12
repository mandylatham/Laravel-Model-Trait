<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\System\Traits\HasComments;
use App\Models\Shared\Model;

/**
 * Reviews Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Review extends Model
{
    use HasComments;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'reviews';

    /**
     * Review status types
     *
     * @var string CREATED
     */
    const CREATED = 'created';

    /**
     * Review status approved
     *
     * @var string APPROVED
     */
    const APPROVED = 'approved';

    /**
     * Review status rejected
     *
     * @var string rejected
     */
    const REJECTED = 'rejected';

    /**
     * Status types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::CREATED,
        self::APPROVED,
        self::REJECTED
    ];

    /**
     * Review visible to public
     *
     * @var string VISIBLE
     */
    const VISIBLE = 'true';

    /**
     * Review invisible to public
     */
    const HIDDEN = 'false';

    /**
     * Visible types
     *
     * @var array VISIBLE_TYPES
     */
    const VISIBLE_TYPES = [
        self::VISIBLE,
        self::HIDDEN
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'rate'          => 'integer',
        'name'          => 'string',
        'status'        => 'string',
        'meta_fields'   => 'array',
        'visible'       => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];
}
