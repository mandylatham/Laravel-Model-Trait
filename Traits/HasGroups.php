<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Group;

/**
 * Has Group Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasGroups
{
    /**
     * Returns all attachments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Determins if has any groups
     *
     * @return bool
     * @access public
     */
    public function hasGroups(): bool
    {
        return ($this->groups()->count()) ? true : false;
    }

    /**
     * Determines if has the given group
     *
     * @param App\Model\Group|int|string $group
     *
     * @return bool
     * @access public
     */
    public function hasGroup($group): bool
    {
        if (filled($group)) {
            if (is_numeric($group) && is_finite(intval($group))) {
                $group = Group::where('id', intval($group))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($group)) {
                $group = Group::where('name', $group)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($group instanceof Group) {
                return $this->groups()->where('id', $group->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign the given group
     *
     * @param  App\Model\Group|int|string $group
     * @return bool
     * @access public
     */
    public function assignGroup($group): bool
    {
        if (!$this->hasGroup($group)) {
            if (is_numeric($group) && is_finite(intval($group))) {
                $group = Group::where('id', intval($group))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($group)) {
                $group = Group::where('name', $group)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($group instanceof Group) {
                return ($this->groups()->save($group)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign the given group
     *
     * @param  App\Model\Group|int|string $group
     * @return bool
     * @access public
     */
    public function unassignGroup($group): bool
    {
        if ($this->hasGroup($group)) {
            if (is_numeric($group) && is_finite(intval($group))) {
                $group = Group::where('id', intval($group))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($group)) {
                $group = Group::where('name', $group)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($group instanceof Group) {
                return ($this->groups()->detach($group->id)) ? true : false;
            }
        }

        return false;
    }
}
