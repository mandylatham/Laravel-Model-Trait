<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\Shared\Model;

/**
 * QuoteItem Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class QuoteItem extends Model
{

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'quote_items';

    /**
     * Disable timestamps
     *
     * @var bool timestamps
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer'
        'label'         => 'string',
        'description'   => 'string',
        'unit'          => 'string',
        'quantity'      => 'double',
        'price'         => 'integer',
        'meta_fields'   => 'array'
    ];
}
