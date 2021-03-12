<?php

namespace App\Models\System;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Shared\Model;

/**
 * Blog Posts Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Post extends Model implements HasMedia, Searchable
{
    use HasMediaTrait;
    use RevisionableTrait;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'posts';

    /**
     * Status active
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Status inactive
     *
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * Status types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::INACTIVE
    ];

    /**
     * Post visible
     *
     * @var string VISIBLE
     */
    const VISIBLE = 'true';

    /**
     * Post hidden
     *
     * @var string HIDDEN
     */
    const HIDDEN = 'false';

    /**
     * Visible Types
     *
     * @var array VISIBLE_TYPES
     */
    const VISIBLE_TYPES = [
        self::VISIBLE,
        self::HIDDEN
    ];

    /**
     * Meta Robots Options
     *
     * @var array META_ROBOTS
     */
    const META_ROBOTS = [
        'NONE',
        'NOINDEX',
        'NOFOLLOW',
        'NOCACHE',
        'NOSNIPPET',
        'NOIMAGEINDEX',
        'INDEX',
        'FOLLOW',
        'SNIPPET',
    ];

    /**
     * Resized Images
     *
     * @param  Media $media
     * @return void
     * @access public
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10)
            ->keepOriginalImageFormat()
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(800)
            ->height(800)
            ->sharpen(10)
            ->keepOriginalImageFormat()
            ->nonQueued();

        $this->addMediaConversion('x-large')
            ->width(1024)
            ->height(768)
            ->sharpen(10)
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

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
        'id'                => 'string',
        'title'             => 'string',
        'slug'              => 'string',
        'content'           => 'string',
        'excerpt'           => 'string',
        'seo_title'         => 'string',
        'meta_keywords'     => 'string',
        'meta_description'  => 'string',
        'meta_rebots'       => 'string',
        'meta_fields'       => 'array',
        'status'            => 'string',
        'visible'           => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime'
    ];
}
