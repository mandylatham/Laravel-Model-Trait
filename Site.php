<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Traits\HasAppointments;
use App\Models\System\Traits\HasBlogs;
use App\Models\System\Traits\HasCarts;
use App\Models\System\Traits\HasCalendarEvents;
use App\Models\System\Traits\HasCountries;
use App\Models\System\Traits\HasOffices;
use App\Models\System\Traits\HasForums;
use App\Models\System\Traits\HasInvoiceItems;
use App\Models\System\Traits\HasMenus;
use App\Models\System\Traits\HasNotes;
use App\Models\System\Traits\HasOrders;
use App\Models\System\Traits\HasPackages;
use App\Models\System\Traits\HasPages;
use App\Models\System\Traits\HasProductAttributes;
use App\Models\System\Traits\HasProducts;
use App\Models\System\Traits\HasProductTypes;
use App\Models\System\Traits\HasQuotes;
use App\Models\System\Traits\HasRedirects;
use App\Models\System\Traits\HasRefunds;
use App\Models\System\Traits\HasSettings;
use App\Models\System\Traits\HasStates;
use App\Models\System\Traits\HasSubscriptions;
use App\Models\System\Traits\HasTags;
use App\Models\System\Traits\HasUsers;
use App\Models\System\Traits\HasIndustries;

/**
 * Sites Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Site extends Model
{
    use HasAppointments;
    use HasCalendarEvents;
    use HasOffices;
    use HasCarts;
    use HasCountries;
    use HasForums;
    use HasInvoiceItems;
    use HasMenus;
    use HasNotes;
    use HasOrders;
    use HasPackages;
    use HasPages;
    use HasProductAttributes;
    use HasProducts;
    use HasProductTypes;
    use HasQuotes;
    use HasRedirects;
    use HasRefunds;
    use HasSettings;
    use HasStates;
    use HasSubscriptions;
    use HasTags;
    use HasUsers;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'sites';

    /**
     * Status
     *
     * @var string INACTIVE
     */
    const ACTIVE = 'active';

    /**
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * Site status types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::INACTIVE
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
     * The attributes that should be cast to native types.
     *
     * @var    array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'name'          => 'string',
        'domain'        => 'string',
        'status'        => 'string',
        'uuid'          => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime'
    ];
}
