<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

/**
 * Company Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Company extends Model implements HasMedia, Searchable
{
    use HasMediaTrait;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'companies';

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
     * active status
     *
     * @var string STATUS_ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * inactive status
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
     * Notifications
     *
     * @var array NOTIFCATIONS
     */
    const NOTIFCATIONS = [
        'Email',
        'SMS',
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
     * @var array
     */
    protected $casts = [
        'company'           => 'string',
        'address'           => 'string',
        'address_2'         => 'string',
        'city'              => 'string',
        'state'             => 'string',
        'zipcode'           => 'string',
        'country'           => 'string',
        'phone'             => 'string',
        'mobile_phone'      => 'string',
        'fax_number'        => 'string',
        'status'            => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime'
    ];
}
