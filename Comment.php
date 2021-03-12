<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\Shared\Model;

/**
 * Comments Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Comment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'comments';

    /**
     * @var string EVERYONE
     */
    const EVERYONE = 'everyone';

    /**
     * @var string OWNER_ONLY
     */
    const OWNER = 'owner';

    /**
     * @var string ADMIN
     */
    const ADMIN = 'admin';


    /**
     * @var array VISIBLITY_TYPES
     */
    const VISIBLE_TYPES = [
        self::ADMIN,
        self::OWNER,
        self::EVERYONE
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'title'         => 'string',
        'content'       => 'integer',
        'meta_fields'   => 'array',
        'visibility'    => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
