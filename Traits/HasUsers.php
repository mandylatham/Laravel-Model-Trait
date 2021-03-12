<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\User;

/**
 * Has User Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasUsers
{
    /**
     * Return user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Determines if has any users.
     *
     * @return bool
     * @access public
     */
    public function hasUsers(): bool
    {
        return ($this->users()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given user.
     *
     * @param  \App\Models\System\User|int $user
     * @return bool
     * @access public
     */
    public function hasUser($user): bool
    {
        if (filled($user)) {
            if (is_numeric($user) && is_finite(intval($user))) {
                return $this->users()->where('id', intval($user))->exists();
            }

            if ($user instanceof User) {
                return $this->users()->where('id', $user->id)->exists();
            } return false;
        }

        return false;
    }

    /**
     * Assigns a given user.
     *
     * @param  \App\Models\System\User|int $user
     * @return bool
     * @access public
     */
    public function assignUser($user): bool
    {
        if (!$this->hasUser($user)) {
            if (is_numeric($user) && is_finite(intval($user))) {
                $user = User::where('id', intval($user))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($user instanceof User) {
                return ($this->users()->save($user)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unasign a given user.
     *
     * @param \App\Models\System\User|int $user
     */
    public function unassignUser($user): bool
    {
        if ($this->hasUser($user)) {
            if (is_numeric($user) && is_finite(intval($user))) {
                return ($this->users()->detach(intval($user))) ? true : false;
            }

            if ($user instanceof $user) {
                return ($this->users()->detach($user->id)) ? true : false;
            }
        }

        return true;
    }
}
