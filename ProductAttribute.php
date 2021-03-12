<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Product Attribute Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class ProductAttribute extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'product_attributes';

    /**
     * Disable timestamps
     *
     * @var    bool $timestamps
     * @access public
     */
    public $timestamps = false;

    /**
     * Product type status
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Product type inactive
     *
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

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
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'name'      => 'string',
        'label'     => 'string',
        'value'     => 'string',
        'status'    => 'string'
    ];
}
