<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Models\System\Traits\HasQuoteItems;
use App\Models\Shared\Model;

/**
 * Quote Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Quote extends Model implements HasMedia, Searchable
{
    use HasMediaTrait;
    use HasQuoteItems;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'quotes';

    /**
     * @var string GENERIC
     */
    const GENERIC = 'generic';

    /**
     * @var array TYPES
     */
    const TYPES = [
        self::GENERIC
    ];

    /**
     * @var string DRAFT
     */
    const DRAFT = 'draft';

    /**
     * @var string QUOTED
     */
    const QUOTED = 'quoted';

    /**
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::DRAFT,
        self::QUOTED
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
        'id'                => 'integer',
        'uuid'              => 'string',
        'user_id'           => 'integer',
        'reference'         => 'string',
        'type'              => 'string',
        'status'            => 'string',
        'notes'             => 'string',
        'private_notes'     => 'string',
        'meta_fields'       => 'array',
        'modified_at'       => 'datetime',
        'created_at'        => 'datetime',
        'deleted_at'        => 'datetime'
    ];
}
