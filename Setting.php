<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Models\System\Traits\HasGroups;

/**
 * Settings Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Setting extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasGroups;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'settings';

    /**
     * Disable timestamps
     *
     * @var    bool $timestamps
     * @access public
     */
    public $timestamps = false;

    /**
     * @var string INPUT_FILE
     */
    const INPUT_FILE = 'file';

    /**
     * @var string INPUT_TEXT
     */
    const INPUT_TEXT = 'text';

    /**
     * @var string INPUT_EMAIL
     */
    const INPUT_EMAIL = 'email';

    /**
     * @var string INPUT_TEXT
     */
    const INPUT_NUMBER = 'number';

    /**
     * @var string INPUT_TEXTAREA
     */
    const INPUT_TEXTAREA = 'textarea';

    /**
     * @var string INPUT_SELECT
     */
    const INPUT_SELECT = 'select';

    /**
     * @var string INPUT_MULTISELECT
     */
    const INPUT_MULTISELECT = 'multiselect';

    /**
     * @var string INPUT_RANGE
     */
    const INPUT_RANGE = 'range';

    /**
     * @var string INPUT_RESOURCE_SELECT
     */
    const INPUT_RESOURCE_SELECT = 'resource_select';

    /**
     * @var const INPUT_TYPES
     */
    const INPUT_TYPES = [
        self::INPUT_FILE,
        self::INPUT_TEXT,
        self::INPUT_TEXTAREA,
        self::INPUT_SELECT,
        self::INPUT_MULTISELECT,
        self::INPUT_RANGE,
        self::INPUT_RESOURCE_SELECT
    ];

    /**
     * @var string LOCKED
     */
    const LOCKED = 'locked';

    /**
     * @var string UNLOCKED
     */
    const UNLOCKED = 'unlocked';

    /**
     * @var array LOCK_TYPES
     */
    const LOCK_TYPES = [
        self::UNLOCKED,
        self::LOCKED
    ];

    /**
     * @var string REQUIRED
     */
    const REQUIRED = 'true';

    /**
     * @var string NOT_REQUIRED
     */
    const NOT_REQUIRED = 'false';

    /**
     * @var array REQUIRED_TYPES
     */
    const REQUIRED_TYPES = [
        self::REQUIRED,
        self::NOT_REQUIRED
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
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'key'       => 'string',
        'value'     => 'string',
        'type'      => 'string',
        'required'  => 'string',
        'options'   => 'string',
        'lock'      => 'string'
    ];
}
