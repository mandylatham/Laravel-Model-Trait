<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

/**
 * Tag Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Tag extends Model implements Searchable
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'tags';

    /**
     * Disable timestamps
     */
    public $timestamps = false;

    /**
     * @var string BLOG
     */
    const BLOG = 'blog';

    /**
     * @var string FOLDER
     */
    const FOLDER = 'folder';

    /**
     * @var string PAGE
     */
    const PAGE = 'page';

    /**
     * @var string POST
     */
    const POST = 'post';

    /**
     * @var string FORUM
     */
    const FORUM = 'forum';

    /**
     * @var string PACKAGE
     */
    const PACKAGE = 'package';

    /**
     * @var string PRODUCT
     */
    const PRODUCT = 'product';

    /**
     * @var string REFUND
     */
    const REFUND = 'refund';

    /**
     * @var string ORDER
     */
    const ORDER = 'order';

    /**
     * @var string SUBSCRIPTION
     */
    const SUBSCRIPTION = 'subscription';

    /**
     * @var string SUPPORT_TICKET
     */
    const SUPPORT_TICKET = 'support_ticket';

    /**
     * @var string USER
     */
    const USER = 'user';

    /**
     * @var string TYPES
     */
    const TYPES = [
        self::BLOG,
        self::FOLDER,
        self::FORUM,
        self::PACKAGE,
        self::PAGE,
        self::PRODUCT,
        self::REFUND,
        self::POST,
        self::TENANT,
        self::SUPPORT_TICKET,
        self::SUBSCRIPTION,
        self::ORDER,
        self::USER,
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
            ($this->first_name . ' ' . $this->last_name . ' (' . $this->email . ')'),
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
        'type' => 'string',
        'name' => 'string',
        'label' => 'string',
    ];
}
