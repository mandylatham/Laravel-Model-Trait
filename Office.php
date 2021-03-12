<?php

declare(strict_types=1);

namespace App\Models\System;

use App\Models\System\Traits\HasAppointments;
use App\Models\System\Traits\HasCalendarEvents;
use App\Models\System\Traits\HasUsers;
use App\Models\Shared\Model;

/**
 * Office Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Office extends Model
{
    use HasCalendarEvents,
        HasAppointments,
        HasUsers;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'offices';

    /**
     * @var string ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::INACTIVE,
        self::ACTIVE
    ];

    /**
     * @var array MERIDIUM_TYPES
     */
    const MERIDIUM_TYPES = [
        'am' => 'AM',
        'pm' => 'PM'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
        'meta_fields',
        'status'
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
        'name'          => 'string',
        'meta_fields'   => 'array',
        'status'        => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];

    public function getOwner()
    {
        foreach($this->users()->get() as $user){
            if($user->hasRole(Role::OWNER)){
                return $user;
            }
        }
        return false;
    }

}
