<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasProductAttributes;
use App\Models\Shared\Model;

/**
 * Products Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Product extends Model implements HasMedia, Searchable
{
    use HasProductAttributes;
    use HasMediaTrait;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'products';

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
     * Product active
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Product inactive
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
     * Product featured
     *
     * @var string FEATURED
     */
    const FEATURED = 'true';

    /**
     * Product not featured
     *
     * @var string NOT_FEATURED
     */
    const NOT_FEATURED = 'false';

    /**
     * Featured types
     *
     * @var string FEATURED_TYPES
     */
    const FEATURED_TYPES = [
        self::FEATURED,
        self::NOT_FEATURED
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'                => 'integer',
        'uuid'              => 'string',
        'name'              => 'string',
        'label'             => 'string',
        'slug'              => 'string',
        'type'              => 'string',
        'description'       => 'string',
        'tags'              => 'string',
        'price'             => 'integer',
        'featured'          => 'string',
        'status'            => 'string',
        'meta_fields'       => 'array',
        'stripe_product'    => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime'
    ];
}
