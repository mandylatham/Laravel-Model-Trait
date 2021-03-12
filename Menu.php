<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use App\Models\System\Traits\HasMenuItems;

/**
 * Menu Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Menu extends Model
{
    use HasMenuItems;

    /**
     * The database table used by the model.
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'menus';

    /**
     * Disable timestamps
     *
     * @var    bool $timestamps
     * @access public
     */
    public $timestamps = false;

    /**
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * @var string NAVIGATION
     */
    const NAVIGATION = 'navigation';

    /**
     * @var string LIST
     */
    const SIMPLE_LIST = 'simple_list';

    /**
     * @var array MENU_TYPES
     */
    const MENU_TYPES = [
        self::NAVIGATION,
        self::SIMPLE_LIST
    ];

    /**
     * Status Types
     *
     * @var string STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::INACTIVE
    ];

    /**
     * @var string HEADER
     */
    const HEADER = 'header';

    /**
     * @var string FOOTER
     */
    const FOOTER = 'footer';

    /**
     * @var string SIDEBAR_LEFT
     */
    const SIDEBAR_LEFT = 'sidebar_left';

    /**
     * @var string SIDEBAR_RIGHT
     */
    const SIDEBAR_RIGHT = 'sidebar_right';

    /**
     * @var string TENANT_MODULE
     */
    const TENANT_MENU = 'tenant_menu';

    /**
     * @var array LOCATIONS
     */
    const LOCATION_TYPES = [
        self::HEADER,
        self::FOOTER,
        self::SIDEBAR_LEFT,
        self::SIDEBAR_RIGHT,
        self::TENANT_MENU
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'type'          => 'string',
        'name'          => 'string',
        'label'         => 'string',
        'location'      => 'string',
        'css_classes'   => 'string',
        'status'        => 'string'
    ];
}
