<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Attachments Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Attachment extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The database table used by the model.
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'attachments';

    /**
     * Status available
     *
     * @var string STATUS_AVAILABLE
     */
    const AVAILABLE = 'available';

    /**
     * Status unavailable
     *
     * @var string STATUS_UNAVAILABLE
     */
    const UNAVAILABLE = 'unavailable';

    /**
     * Status Types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::AVAILABLE,
        self::UNAVAILABLE
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'uuid'          => 'string',
        'name'          => 'string',
        'path'          => 'string',
        'mime_type'     => 'string',
        'status'        => 'string',
        'downloads'     => 'integer',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
