<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
use App\Models\System\Traits\HasAppointments;
use App\Models\System\Traits\HasCalendarEvents;
use App\Models\System\Traits\HasOrders;
use App\Models\System\Traits\HasCarts;
use App\Models\System\Traits\HasPayments;
use App\Models\System\Traits\HasReviews;
use App\Models\System\Traits\HasSettings;
use App\Models\System\Traits\HasMessages;
use App\Models\System\Traits\HasOffices;
use App\Models\System\Traits\HasSupportTickets;
use App\Models\Shared\Traits\HasMetaFields;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Models\Shared\Authenticatable;

/**
 * User Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class User extends Authenticatable implements Searchable, HasMedia, MustVerifyEmail
{
    use Notifiable;
    use Billable;
    use HasRoles;
    use HasOffices;
    use HasAppointments;
    use HasCalendarEvents;
    use HasOrders;
    use HasCarts;
    use HasPayments;
    use HasReviews;
    use HasSettings;
    use HasMediaTrait;
    use HasMessages;
    use HasSupportTickets;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var    string
     * @access protected
     */
    protected $table = 'users';

    /**
     * The database guard
     */
    protected $guard_name  = 'web';

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
     * @var string GUARD
     */
    const GUARD = 'web';

    /**
     * Maximum size of generated username
     *
     * @var int USERNAME_LENGTH
     */
    const USERNAME_LENGTH = 10;

    /**
     * @var int PASSWORD_CHANGE_DAYS
     */
    const PASSWORD_CHANGE_DAYS = 90;

    /**
     * User active status
     *
     * @var string STATUS_ACTIVE
     */
    const ACTIVE = 'active';

    /**
     * User inactive status
     *
     * @var string INACTIVE
     */
    const INACTIVE = 'inactive';

    /**
     * Customer status types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::INACTIVE
    ];

    /**
     * Setup incomplete.
     *
     * @var string SETUP_INCOMPLETE
     */
    const SETUP_INCOMPLETE = 'false';

    /**
     * Setup completed.
     *
     * @var string SETUP_COMPLETED
     */
    const SETUP_COMPLETED = 'true';

    /**
     * Setup Ignored for roles other then ROLE::USER
     */
    const SETUP_IGNORED = 'ignored';

    /**
     * Setup status
     *
     * @var string SETUP_STATUES
     */
    const SETUP_STATUES = [
        self::SETUP_IGNORED ,
        self::SETUP_COMPLETED,
        self::SETUP_INCOMPLETE
    ];

    /**
     * Terms Accepted
     *
     * @var string TERMS_ACCEPTED
     */
    const TERMS_ACCEPTED = 'true';

    /**
     * Terms Declined
     *
     * @var string TERMS_DECLINED
     */
    const TERMS_DECLINED = 'false';

    /**
     * Terms Types
     *
     * @var array TERM_TYPES
     */
    const TERMS_TYPES = [
        self::TERMS_ACCEPTED,
        self::TERMS_DECLINED
    ];

    /**
     * Marketing Accepted
     *
     * @var string MARKETING_ACCEPTED
     */
    const MARKETING_ACCEPTED = 'true';

    /**
     * Marketing Declined
     *
     * @var string MARKETING_DECLINED
     */
    const MARKETING_DECLINED = 'false';

    /**
     * Marketing Types
     *
     * @var array MARKETING_TYPES
     */
    const MARKETING_TYPES = [
        self::MARKETING_ACCEPTED,
        self::MARKETING_DECLINED
    ];

    /**
     * @var string NOTIFCATION_EMAIL
     */
    const NOTIFCATION_EMAIL = 'email';

    /**
     * @var string NOTIFCATION_SMS
     */
    const NOTIFCATION_SMS = 'sms';

    /**
     * Notifications
     *
     * @var array NOTIFCATIONS
     */
    const NOTIFCATIONS = [
        self::NOTIFCATION_EMAIL,
        self::NOTIFCATION_SMS
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company',
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'status',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid',
        'password',
        'remember_token',
        'stripe_id',
        'payment_method',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'uuid'              => 'string',
        'email'             => 'string',
        'username'          => 'string',
        'password'          => 'string',
        'company'           => 'string',
        'first_name'        => 'string',
        'last_name'         => 'string',
        'address'           => 'string',
        'address_2'         => 'string',
        'city'              => 'string',
        'state'             => 'string',
        'zipcode'           => 'string',
        'country'           => 'string',
        'phone'             => 'string',
        'mobile_phone'      => 'string',
        'meta_fields'       => 'array',
        'stripe_id'         => 'string',
        'payment_method'    => 'string',
        'card_brand'        => 'string',
        'card_full_name'    => 'string',
        'card_last_four'    => 'integer',
        'card_country'      => 'string',
        'card_funding'      => 'string',
        'card_last_four'    => 'integer',
        'card_exp_month'    => 'integer',
        'card_exp_year'     => 'integer',
        'notifications'     => 'string',
        'status'            => 'string',
        'setup_completed'   => 'string',
        'terms'             => 'string',
        'marketing'         => 'string',
        'user_agent'        => 'string',
        'remember_token'    => 'string',
        'ip_address'        => 'string',
        'trial_ends_at'     => 'datetime',
        'email_verified_at' => 'datetime',
        'last_login_at'     => 'datetime',
        'last_activity_at'  => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime'
    ];
}
