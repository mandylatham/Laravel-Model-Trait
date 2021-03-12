<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasForumPosts;
use App\Models\Shared\Model;

/**
 * Forum Discussions Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class ForumDiscussion extends Model implements Searchable
{
    use HasForumPosts;
    use SoftDeletes;

    /**
     * Database table for model
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'forum_discussions';

    /**
     * @var string OPEN
     */
    const OPEN = 'open';

    /**
     * @var string CLOSED
     */
    const CLOSED = 'closed';


    /**
     * @var array STATUES
     */
    const STATUS_TYPES = [
        self::OPEN,
        self::CLOSED
    ];

    /**
     * @var string STICKY_DISABLED;
     */
    const STICKY_DISABLED = 'false';

    /**
     * @var string STICKY_ENABLED
     */
    const STICKY_ENABLED = 'true';

    /**
     * @var array STICKY_TYPES
     */
    const STICKY_TYPES = [
        self::STICKY_DISABLED,
        self::STICKY_ENABLED
    ];

    /**
     * @var string NOT_ANSWERED
     */
    const NOT_ANSWERED = 'false';

    /**
     * @var string ANSWERED
     */
    const ANSWERED = 'true';

    /**
     * @var string ANSWERED_TYPES
     */
    const ANSWERED_TYPES = [
        self::NOT_ANSWERED,
        self::ANSWERED
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
            null
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
        'category_id'   => 'integer',
        'slug'          => 'string',
        'title'         => 'string',
        'status'        => 'string',
        'meta_fields'   => 'array',
        'sticky'        => 'string',
        'answered'      => 'string',
        'views'         => 'integer',
        'sort'          => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
