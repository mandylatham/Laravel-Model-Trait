<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Traits\HasForumDiscussions;
use App\Models\Shared\Model;

/**
 * Forum Category Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class ForumCategory extends Model
{
    use HasForumDiscussions;
    use SoftDeletes;

    /**
     * Database table for model
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'forum_categories';

    /**
     * Active status
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Inactive status
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
     * @var    array Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'parent_id'     => 'integer',
        'name'          => 'string',
        'slug'          => 'string',
        'status'        => 'string',
        'meta_fields'   => 'array',
        'sort'          => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime'
    ];
}
