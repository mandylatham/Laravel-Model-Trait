<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Tag;

/**
 * Has Tags Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasTags
{
    /**
     * Gets Tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Checks if has any tag
     *
     * @return bool
     * @access public
     */
    public function hasTags(): bool
    {
        return ($this->tags->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given tag
     *
     * @param App\Models\System\Tag|int|string $tag
     *
     * @return bool
     * @access public
     */
    public function hasTag($tag): bool
    {
        if (filled($tag)) {
            if (is_numeric($tag) && is_finite(intval($tag))) {
                return $this->tags()->where('id', intval($tag))->exists();
            }

            if (is_string($tag)) {
                return $this->tags()->where('name', $tag)->exists();
            }

            if ($tag instanceof Tag) {
                return $this->tags()->where('id', $tag->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given tag
     *
     * @param App\Models\System\Tag|int|string $tag
     *
     * @return bool
     * @access public
     */
    public function assignTag($tag): bool
    {
        if (!$this->hasTag($tag)) {
            if (is_numeric($tag) && is_finite(intval($tag))) {
                $tag = Tag::where('id', intval($tag))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($tag)) {
                $tag = Tag::where('name', $tag)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($tag instanceof Tag) {
                return ($this->tags()->save($tag)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given tag
     *
     * @param App\Models\System\Tag|int|string $tag
     *
     * @return bool
     * @access public
     */
    public function unassignTag($tag): bool
    {
        if ($this->hasTag($tag)) {
            if (is_numeric($tag) && is_finite(intval($tag))) {
                $tag = $this->tags()->where('id', intval($tag))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($tag)) {
                $tag = $this->tags()->where('name', $tag)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($tag instanceof Tag) {
                return ($this->tags()->detach($tag->id)) ? true : false;
            }
        }

        return false;
    }
}
