<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * Translation Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Translation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'translations';

    /**
     * @var string LOCALE_EN
     */
    const DEFAULT_LOCALE = 'en';

    /**
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'locale'        => 'string',
        'content'       => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
