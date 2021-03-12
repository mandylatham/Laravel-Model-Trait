<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasComments;

/**
 * Forum Posts Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class ForumPost extends Model implements Searchable
{
    use HasComments;

    /**
     * Database table for model
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'forum_posts';

    /**
     * @var string PUBLISHED
     */
    const PUBLISHED = 'published';

    /**
     * @var string DRAFT
     */
    const DRAFT = 'draft';

    /**
     * @var string HIDDEN
     */
    const HIDDEN = 'hidden';

    /**
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * @var array STATUS_TYPE
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::INACTIVE
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
        'user_id'       => 'integer',
        'discussion_id' => 'integer',
        'body'          => 'integer',
        'status'        => 'string',
        'views'         => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
