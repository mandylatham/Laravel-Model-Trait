<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\Shared\Model;

/**
 * Note Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Note extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'notes';

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'parent_id'     => 'integer',
        'user_id'       => 'integer',
        'content'       => 'string',
        'meta_fields'   => 'array',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
