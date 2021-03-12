<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasForumDiscussions;
use App\Models\System\Traits\HasForumCategories;
use App\Models\System\Traits\HasForumPosts;
use App\Models\Shared\Model;

/**
 * Forum Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Forum extends Model implements Searchable
{
    use HasForumDiscussions;
    use HasForumCategories;
    use HasForumPosts;
    use SoftDeletes;

    /**
     * Database table for model
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'forums';

    /**
     * Active status
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Inactive status
     *
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * Status Types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::INACTIVE
    ];

    /**
     * Forum Visible
     *
     * @var string VISIBLE
     */
    const VISIBLE = 'visible';

    /**
     * Forum Hidden
     *
     * @var string HIDDEN
     */
    const HIDDEN = 'hidden';

    /**
     * Visibility types
     *
     * @var array VISIBLE_TYPES
     */
    const VISIBLE_TYPES = [
        self::VISIBLE,
        self::HIDDEN
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
            $this->title,
            null,
        );
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'slug'          => 'string',
        'title'         => 'string',
        'status'        => 'string',
        'meta_fields'   => 'array',
        'visible'       => 'string',
        'created_at'    => 'string',
        'updated_at'    => 'string'
    ];
}
