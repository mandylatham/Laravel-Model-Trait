<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Menu Items Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class MenuItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'menu_items';

    /**
     * Disable timestamps
     *
     * @var    bool $timestamps
     * @access public
     */
    public $timestamps = false;

    /**
     * @var string TARGET
     */
    const TARGET_BLANK = '_blank';

    /**
     * @var string TARGET_SELF
     */
    const TARGET_SELF = '_self';

    /**
     * @var array TARGET_TYPES
     */
    const TARGET_TYPES = [
        self::TARGET_SELF,
        self::TARGET_BLANK
    ];

    /**
     * @var string PARENT_ITEM
     */
    const PARENT_ITEM = 'parent';

    /**
     * @var string CHILD_ITEM
     */
    const CHILD_ITEM = 'child';

    /**
     * @var string SUBMENU_ITEM
     */
    const SUBMENU_ITEM = 'submenu';

    /**
     * @var string TYPES
     */
    const MENU_ITEM_TYPES = [
        self::PARENT_ITEM,
        self::CHILD_ITEM,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'parent_id'     => 'integer',
        'type'          => 'string',
        'name'          => 'string',
        'label'         => 'string',
        'url'           => 'string',
        'css_classes'   => 'string',
        'position'      => 'integer'
    ];
}
