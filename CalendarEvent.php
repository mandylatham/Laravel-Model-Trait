<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\System\Traits\HasAppointments;
use App\Models\Shared\Model;

/**
 * CalendarEvent Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class CalendarEvent extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'calendar_events';

    /**
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * @var string OPEN
     */
    const OPEN = 'opem';

    /**
     * @var string BOOKED
     */
    const BOOKED = 'booked';

    /**
     * @var string BOOKED
     */
    const CONFIRMED = 'confirmed';

    /**
     * @var string OFF_SET_VISIT_TYPE
     */
    const OFF_SET_VISIT_TYPE = 'off_set_visit';

    /**
     * @var string REP_VISIT_TYPE
     */
    const REP_VISIT_TYPE = 'rep_visit';

    /**
     * @var array VISIT_TYPES
     */
    const VISIT_TYPES = [
        self::OFF_SET_VISIT_TYPE,
        self::REP_VISIT_TYPE
    ];

    /**
     * @var string RECURRING
     */
    const RECURRING = 'true';

    /**
     * @var string NOT_RECURRING
     */
    const NOT_RECURRING = 'false';

    /**
     * @var string REPEAT_WEEKLY
     */
    const REPEAT_WEEKLY = 'weekly';

    /**
     * @var string REPEAT_MONTHLY
     */
    const REPEAT_MONTHLY = 'monthly';

    /**
     * @var array REPEAT_TYPES
     */
    const REPEAT_TYPES = [
        self::REPEAT_WEEKLY,
        self::REPEAT_MONTHLY
    ];

    /**
     * @var array RECURRING_TYPES
     */
    const RECURRING_TYPES = [
        self::NOT_RECURRING,
        self::RECURRING
    ];

    /**
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::INACTIVE,
        self::ACTIVE
    ];

    /**
     * @var EVENT_STATUSES
     */
    const EVENT_STATUSES = [
        self::OPEN,
        self::BOOKED,
        self::CONFIRMED
    ];

    /**
     * @var string NEW_YEARS_EVE
     */
    const NEW_YEARS_EVE = '12/31';

    /**
     * @var string NEW_YEARS_DAY
     */
    const NEW_YEARS_DAY = '01/1';

    /**
     * @var string MLK_DAY
     */
    const MLK_DAY = '01/18';

    /**
     * @var string EASTER DAY
     */
    const EASTER_DAY = 'last sunday of march';

    /**
     * @var string GOOD_FRIDAY
     */
    const GOOD_FRIDAY = '04/2';

    /**
     * @var string PRESIDENTS_DAY
     */
    const PRESIDENTS_DAY = 'third monday/OD February';

    /**
     * @var string MEMORIAL_DAY
     */
    const MEMORIAL_DAY = '5/31';

    /**
     * @var string INDEPENDENCE_DAY
     */
    const INDEPENDENCE_DAY = '06/4';

    /**
     * @var string LABOR_DAY
     */
    const LABOR_DAY = '09/6';

    /**
     * @var string COLUMBUS_DAY
     */
    const COLUMBUS_DAY = '10/11';

    /**
     * @var string VETERANS_DAY
     */
    const VETERANS_DAY = '11/11';

    /**
     * @var string CHRISTMAS_EVE
     */
    const CHRISTMAS_EVE = '12/24';

    /**
     * @var string CHRISTMAS_DAY
     */
    const CHRISTMAS_DAY = '12/25';

    /**
     *  Associative array for holidays
     *
     * @var array HOLIDAYS
     */
    const HOLIDAYS = [
        'new_years_eve'     => self::NEW_YEARS_EVE,
        'new_years'         => self::NEW_YEARS_DAY,
        'mlk_day'           => self::MLK_DAY,
        'easter_day'        => self::EASTER_DAY,
        'good_friday'       => self::GOOD_FRIDAY,
        'presidents_day'    => self::PRESIDENTS_DAY,
        'memorial_day'      => self::MEMORIAL_DAY,
        'independence_day'  => self::INDEPENDENCE_DAY,
        'labor_day'         => self::LABOR_DAY,
        'columbus_day'      => self::COLUMBUS_DAY,
        'veterans_day'      => self::VETERANS_DAY,
        'christmas_eve'     => self::CHRISTMAS_EVE,
        'christmas_day'     => self::CHRISTMAS_DAY,
    ];

    /**
     *
     * @var HOLIDAYS_LIST
     */
    const HOLIDAYS_LIST = [
        self::NEW_YEARS_EVE,
        self::NEW_YEARS_DAY,
        self::MLK_DAY,
        self::EASTER_DAY,
        self::GOOD_FRIDAY,
        self::PRESIDENTS_DAY,
        self::MEMORIAL_DAY,
        self::INDEPENDENCE_DAY,
        self::LABOR_DAY,
        self::COLUMBUS_DAY,
        self::VETERANS_DAY,
        self::CHRISTMAS_EVE,
        self::CHRISTMAS_DAY,
    ];

    /**
     * @var string SUNDAY
     */
    const SUNDAY = 'sunday';

    /**
     * @var string MONDAY
     */
    const MONDAY = 'monday';

    /**
     * @var string TUESDAY
     */
    const TUESDAY = 'tuesday';

    /**
     * @var string WEDNESDAY
     */
    const WEDNESDAY = 'wednesday';

    /**
     * @var string THRUSDAY
     */
    const THRUSDAY = 'thursday';

    /**
     * @var string FRIDAY
     */
    const FRIDAY = 'friday';

    /**
     * @var string SATURDAY
     */
    const SATURDAY = 'saturday';

    /**
     * @var array DAYS
     */
    const DAYS = [
        self::SUNDAY,
        self::MONDAY,
        self::TUESDAY,
        self::WEDNESDAY,
        self::THRUSDAY,
        self::FRIDAY,
        self::SATURDAY
    ];

    /**
     * Get New Years Eve
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getNewYearsEveDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::NEW_YEARS_EVE . '/' . $year));
    }

    /**
     * Get New Years Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getNewYearsDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::NEW_YEARS_DAY . '/' . $year));
    }

    /**
     * Get MLK Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getMLKDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::MLK_DAY . '/' . $year));
    }

    /**
     * Get Good Friday
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getGoodFriday(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::GOOD_FRIDAY . '/' . $year));
    }

    /**
     * Get Memorial Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getMemorialDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::MEMORIAL_DAY . '/' . $year));
    }

    /**
     * Get Veterans Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getVeteransDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::VETERANS_DAY . '/' . "{$year}"));
    }

    /**
     * Get Columbus Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getColumbusDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::COLUMBUS_DAY . '/' . $year));
    }

    /**
     * Get Independence Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getIndependenceDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::INDEPENDENCE_DAY . '/' . $year));
    }

    /**
     * Get Presidents day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getPresidentsDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::PRESIDENTS_DAY . " {$year}"));
    }

    /**
     * Get Easter Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getEasterDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::EASTER_DAY . " {$year}"));
    }

    /**
     * Get Christmas Eve
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getChristmasEveDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::CHRISTMAS_EVE . '/' . $year));
    }

    /**
     * Get Christmas Day
     *
     * @param  int $year
     * @return string
     * @static
     */
    public static function getChristmasDay(int $year, string $format = 'd/m/Y')
    {
        $year = safe_integer($year);
        return date($format, strtotime(self::CHRISTMAS_DAY . '/' . $year));
    }


    /**
     * @var array SIMPLE_QUERY_SELECT
     */
    const SIMPLE_QUERY_SELECT = [
        'id',
        'title',
        'recurring',
        'status',
        'meta_fields',
        'start_at',
        'ends_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference',
        'title',
        'recurring',
        'meta_fields',
        'status',
        'start_at',
        'ends_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array $casts Type casting field columns before interting to database.
     */
    protected $casts = [
        'id'            => 'integer',
        'uuid'          => 'string',
        'reference'     => 'string',
        'title'         => 'string',
        'recurring'     => 'string',
        'meta_fields'   => 'array',
        'start_at'      => 'datetime',
        'ends_at'       => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
