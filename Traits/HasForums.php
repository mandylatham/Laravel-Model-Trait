<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Form;

/**
 * Has Forums Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasForums
{
    /**
     * Gets Forums Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function forums()
    {
        return $this->belongsToMany(Forum::class);
    }

    /**
     * Checks if has any course material
     *
     * @return bool
     * @access public
     */
    public function hasForums(): bool
    {
        return ($this->forums->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given course material
     *
     * @param App\Models\System\Forum|int|string $forum
     *
     * @return bool
     * @access public
     */
    public function hasForum($forum): bool
    {
        if (filled($forum)) {
            if (is_numeric($forum) && is_finite(intval($forum))) {
                return $this->forums()->where('id', intval($forum))->exists();
            }

            if (is_string($forum)) {
                return $this->forums()->where('name', $forum)->exists();
            }

            if ($forum instanceof Forum) {
                return $this->forums()->where('id', $forum->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given forums
     *
     * @param App\Models\System\Forum|int|string $forum
     *
     * @return bool
     * @access public
     */
    public function assignForum($forum): bool
    {
        if (!$this->hasForum($forum)) {
            if (is_numeric($forum) && is_finite(intval($forum))) {
                $forum = Forum::where('id', intval($forum))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forum)) {
                $forum = Forum::where('name', $forum)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forum instanceof Forum) {
                return ($this->forums()->save($forum)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given forum
     *
     * @param App\Models\System\Forum|int|string $forum
     *
     * @return bool
     * @access public
     */
    public function unassignForum($forum): bool
    {
        if ($this->hasForum($forum)) {
            if (is_numeric($forum) && is_finite(intval($forum))) {
                $forum = $this->forums()->where('id', intval($forum))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forum)) {
                $forum = $this->forums()->where('name', $forum)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forum instanceof Forum) {
                return ($this->forums()->detach($forum->id)) ? true : false;
            }
        }

        return false;
    }
}
