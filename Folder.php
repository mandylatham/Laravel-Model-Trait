<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Folders Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Folder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'folders';

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
