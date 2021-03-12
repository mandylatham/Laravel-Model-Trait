<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\Shared\Model;

/**
 * Cart Lines Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class CartLine extends Model
{
    use HasMetaFields;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'cart_lines';

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'name'          => 'string',
        'price'         => 'integer',
        'quantity'      => 'integer',
        'meta_fields'   => 'array',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
