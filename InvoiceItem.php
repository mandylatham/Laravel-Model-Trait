<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\Shared\Model;

/**
 * Invoice Items Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class InvoiceItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'invoice_items';

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @var string INVENTORY_ITEM
     */
    const INVENTORY_ITEM = 'inventory_item';

    /**
     * @var string NON_INVENTORY_ITEM
     */
    const NOT_INVENTORY_ITEM = 'not_inventory_item';

    /**
     * @var array TYPES
     */
    const ITEM_TYPES = [
        self::INVENTORY_ITEM,
        self::NOT_INVENTORY_ITEM
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
        'sku'           => 'string',
        'label'         => 'string',
        'unit'          => 'string',
        'quantity'      => 'double',
        'price'         => 'integer',
        'notes'         => 'string',
        'meta_fields'   => 'array'
    ];
}
