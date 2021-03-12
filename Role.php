<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Roles Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Role extends SpatieRole
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'roles';

    /**
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * @var SUPER_ADMIN
     */
    const SUPER_ADMIN = 'super_admin';

    /**
     * @var string ADMIN
     */
    const ADMIN = 'admin';

    /**
     * @var string API
     */
    const API = 'api';

    /**
     * @var string OWNER
     */
    const OWNER = 'owner';

    /**
     * @var string GUEST
     */
    const GUEST = 'guest';

    /**
     * @var string USER
     */
    const USER = 'user';

    /**
     * Role for UNASSIGNED users
     *
     * @var string UNASSIGNED
     */
    const UNASSIGNED = 'unassigned';

    /**
     * List of ROLES
     *
     * @var array roles
     */
    const ROLES = [
        self::API,
        self::UNASSIGNED,
        self::SUPER_ADMIN,
        self::ADMIN,
        self::OWNER,
        self::GUEST,
        self::USER
    ];

    /**
     * Role status types
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
        'name'          => 'string',
        'guard_name'    => 'string',
        'label'         => 'string',
        'status'        => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
