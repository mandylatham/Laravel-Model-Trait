<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Groups Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Group extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'groups';

    /**
     * Disable timestamps
     *
     * @var    bool $timestamps
     * @access public
     */
    public $timestamps = false;

    /**
     * Folder Visible
     *
     * @var string VISIBLE
     */
    const VISIBLE = 'true';

    /**
     * Folder Hidden
     *
     * @var string HIDDEN
     */
    const HIDDEN = 'false';

    /**
     * @var string PRODUCT
     */
    const PRODUCT = 'product';

    /**
     * @var string SETTING
     */
    const SETTING = 'setting';

    /**
     * @var string MAIL
     */
    const MAIL = 'MAIL';

    /**
     * @var string _GLOBAL
     */
    const _GLOBAL = 'global';

    /**
     * @var string SYSTEM
     */
    const SYSTEM = 'system';

    /**
     * @var array TYPES
     */
    const TYPES = [
        self::SYSTEM,
        self::_GLOBAL,
        self::SETTING,
        self::MAIL,
        self::PRODUCT
    ];

    /**
     * Folder Visble Types
     *
     * @var string VISIBLE_TYPES
     */
    const VISIBLE_TYPES = [
        self::VISIBLE,
        self::HIDDEN
    ];

    /**
     * Folder Locked
     *
     * @var string LOCKED
     */
    const LOCKED = 'locked';

    /**
     * Folder Unlocked
     *
     * @var string UNLOCKED
     */
    const UNLOCKED = 'unlocked';

    /**
     * Folder Types
     *
     * @var array LOCK_TYPES
     */
    const LOCK_TYPES = [
        self::LOCKED,
        self::UNLOCKED
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'name'      => 'string',
        'label'     => 'string',
        'visible'   => 'string',
        'lock'      => 'string'
    ];
}
