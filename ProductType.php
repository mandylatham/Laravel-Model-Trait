<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Product Types Eloquent Model
 *
 * @copyright MdRepTime, LLC
 * @package   App\Models\System
 */
class ProductType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'product_types';

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
        'status'    => 'string'
    ];
}
