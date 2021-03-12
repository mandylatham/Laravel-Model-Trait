<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasPayments;
use App\Models\System\Traits\HasRefunds;
use App\Models\Shared\Model;

/**
 * Orders Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Order extends Model implements Searchable
{
    use HasPayments;
    use HasRefunds;

    /**
     * Has Cart Relationship
     *
     * @return \App\Models\System\Cart
     */
    public function cart(): ?Cart
    {
        return Cart::where('id', $this->cart_id)->first();
    }

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'orders';

    /**
     * Status order created
     *
     * @var string CREATED
     */
    const CREATED = 'created';

    /**
     * Status order incomplete
     *
     * @var string INCOMPLETE
     */
    const INCOMPLETE = 'incomplete';

    /**
     * Status order completed
     *
     * @var string COMPLETED
     */
    const COMPLETED  = 'completed';

    /**
     * Status order canceled
     *
     * @var string CANCELED
     */
    const CANCELED = 'canceled';

    /**
     * Status Types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::CREATED,
        self::INCOMPLETE,
        self::COMPLETED,
        self::CANCELED
    ];

    /**
     * Returns search sesults
     *
     * @return \Spatie\Searchable\SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->reference,
            null,
        );
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'uuid'          => 'string',
        'cart_id'       => 'integer',
        'status'        => 'string',
        'meta_fields'   => 'array',
        'completed_at'  => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime'
    ];
}
