<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\ForumCategory;

/**
 * Has Forum Category Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits;
 */
trait HasForumCategories
{
    /**
     * Gets forum categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function forumCategories()
    {
        return $this->belongsToMany(ForumCategory::class);
    }

    /**
     * Checks if has any forum category
     *
     * @return bool
     * @access public
     */
    public function hasForumCategories(): bool
    {
        return ($this->forumCategories->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given forum category
     *
     * @param App\Models\System\ForumCategory|int|string $forumCategory
     *
     * @return bool
     * @access public
     */
    public function hasForumCategory($forumCategory): bool
    {
        if (filled($forumCategory)) {
            if (is_numeric($forumCategory) && is_finite(intval($forumCategory))) {
                return $this->forumCategories()->where('id', intval($forumCategory))->exists();
            }

            if (is_string($forumCategory)) {
                return $this->forumCategories()->where('name', $forumCategory)->exists();
            }

            if ($forumCategory instanceof ForumCategory) {
                return $this->forumCategories()->where('id', $forumCategory->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given forum category
     *
     * @param App\Models\System\ForumCategory|int|string $forumCategory
     *
     * @return bool
     * @access public
     */
    public function assignForumCategory($forumCategory): bool
    {
        if (!$this->hasForumCategory($forumCategory)) {
            if (is_numeric($forumCategory) && is_finite(intval($forumCategory))) {
                $forumCategory = ForumCategory::where('id', intval($forumCategory))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forumCategory)) {
                $forumCategory = ForumCategory::where('name', $forumCategory)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forumCategory instanceof ForumCategory) {
                return ($this->forumCategories()->save($forumCategory)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given forum category
     *
     * @param App\Models\System\ForumCategory|int|string $forumCategory
     *
     * @return bool
     * @access public
     */
    public function unassignForumCategory($forumCategory): bool
    {
        if ($this->hasForumCategory($forumCategory)) {
            if (is_numeric($forumCategory) && is_finite(intval($forumCategory))) {
                $forumCategory = $this->forumCategories()->where('id', intval($forumCategory))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forumCategory)) {
                $forumCategory = $this->forumCategories()->where('name', $forumCategory)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forumCategory instanceof ForumCategory) {
                return ($this->forumCategories()->detach($forumCategory->id)) ? true : false;
            }
        }

        return false;
    }
}
