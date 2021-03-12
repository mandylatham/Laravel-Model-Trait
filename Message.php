<?php

declare(strict_types=1);

namespace App\Models\System;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\System\Traits\HasUsers;
use App\Models\System\Traits\HasFolders;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Models\Shared\Model;

/**
 * Messages Eloquent Model
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
class Message extends Model implements Searchable, HasMedia
{
    use HasUsers,
        HasFolders,
        HasMediaTrait;

    /**
     * The database table used by the model.
     *
     * @var    string $table
     * @access protected
     */
    protected $table = 'messages';

    /**
     * @var string USER
     */
    const USER = 'user';

    /**
     * @var string OFFICE
     */
    const OFFICE = 'office';

    /**
     * @var string GUEST_USER
     */
    const GUEST_USER = 'guest_user';

    /**
     * Message sent status
     *
     * @var string SENT
     */
    const SENT = 'sent';

    /**
     * Message read status
     *
     * @var string READ
     */
    const READ = 'read';

    /**
     * Message unread status
     *
     * @var string UNREAD
     */
    const UNREAD = 'unread';

    /**
     * Message deleted status
     *
     * @var string DELETED
     */
    const DELETED = 'deleted';

    /**
     * @var string QUEUE
     */
    const QUEUE = 'queue';

    /**
     * Status Types
     *
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::QUEUE,
        self::SENT,
        self::READ,
        self::UNREAD,
        self::DELETED
    ];

    /**
     * @var array TYPES
     */
    const TYPES = [
        self::USER,
        self::OFFICE,
        self::GUEST_USER
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
     * @var    array Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'uuid'          => 'string',
        'recipient'     => 'integer',
        'type'          => 'string',
        'subject'       => 'string',
        'body'          => 'string',
        'meta_fields'   => 'array',
        'status'        => 'string',
        'sent_at'       => 'datetime',
        'read_at'       => 'datetime',
        'created_at'    => 'datetime',
    ];
}
