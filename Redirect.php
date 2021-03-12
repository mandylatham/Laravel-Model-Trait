<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Redirects Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Redirect extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'redirects';

    /**
     * Disable timestamps
     *
     * @var    bool $timestamps
     * @access public
     */
    public $timestamps = false;

    /**
     * @var array REDIRECT_CODES
     */
    const REDIRECT_CODES = [
        301 => 'Moved permanently',
        307 => 'Temporary redirect',
        308 => 'Permanent redirect'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'name'          => 'string',
        'path'          => 'string',
        'redirect_to'   => 'string',
        'code'          => 'integer'
    ];
}
