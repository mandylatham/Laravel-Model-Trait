<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Traits\HasProducts;
use App\Models\Shared\Model;

/**
 * Packages Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Package extends Model implements HasMedia, Searchable
{
    use HasProducts;
    use HasMediaTrait;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'packages';

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
     * Package active status
     *
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * Package inactive status
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
     * @var string SINGLE
     */
    const LINKED_PRODUCT = 'linked_product';

    /**
     * @var string SUBSCRIPTION
     */
    const SUBSCRIPTION = 'subscription';

    /**
     * Package Types
     *
     * @var array PACKAGE_TYPES
     */
    const PACKAGE_TYPES = [
        self::SUBSCRIPTION,
        self::LINKED_PRODUCT,
    ];

    /**
     * @var string PER_DAY
     */
    const PER_DAY = 'day';

    /**
     * @var string MONTHLY
     */
    const MONTHLY = 'month';

    /**
     * @var string WEEKLY
     */
    const WEEKLY = 'week';

    /**
     * @var string YEARLY
     */
    const YEARLY = 'year';

    /**
     * Package interval plans
     *
     * @var string INTERVAL_PLANS
     */
    const INTERVAL_PLANS = [
        self::PER_DAY,
        self::MONTHLY,
        self::WEEKLY,
        self::YEARLY
    ];

    /**
     * @var string TRIAL_ENABLED
     */
    const TRIAL_ENABLED = 'enabled';

    /**
     * @var string TRIAL_DISABLED
     */
    const TRIAL_DISABLED = 'disabled';

    /**
     * @var array TRIAL_TYPES
     */
    const TRIAL_TYPES = [
        self::TRIAL_DISABLED,
        self::TRIAL_ENABLED
    ];

    /**
     * Package featured
     *
     * @var string FEATURED
     */
    const FEATURED = 'true';

    /**
     * Package not featured
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
        'id'             => 'integer',
        'uuid'           => 'string',
        'name'           => 'string',
        'slug'           => 'string',
        'label'          => 'string',
        'type'           => 'string',
        'description'    => 'string',
        'price'          => 'integer',
        'interval'       => 'string',
        'featured'       => 'string',
        'status'         => 'string',
        'meta_fields'    => 'array',
        'stripe_plan'    => 'string',
        'trial_enabled'  => 'string',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime'
    ];
}
