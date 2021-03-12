<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\ForumPost;

/**
 * Has Forum Posts Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasForumPosts
{
    /**
     * Gets forum posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function forumPosts()
    {
        return $this->belongsToMany(ForumPost::class);
    }

    /**
     * Checks if has any forum post
     *
     * @return bool
     * @access public
     */
    public function hasForumPosts(): bool
    {
        return ($this->forumPosts->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given forum post
     *
     * @param App\Models\System\ForumPost|int|string $forumPost
     *
     * @return bool
     * @access public
     */
    public function hasForumPost($forumPost): bool
    {
        if (filled($forumPost)) {
            if (is_numeric($forumPost) && is_finite(intval($forumPost))) {
                return $this->forumPosts()->where('id', intval($forumPost))->exists();
            }

            if (is_string($forumPost)) {
                return $this->forumPosts()->where('name', $forumPost)->exists();
            }

            if ($forumPost instanceof ForumPost) {
                return $this->forumPosts()->where('id', $forumPost->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given forum post
     *
     * @param App\Models\System\ForumPost|int|string $forumPost
     *
     * @return bool
     * @access public
     */
    public function assignForumPost($forumPost): bool
    {
        if (!$this->hasForumPost($forumPost)) {
            if (is_numeric($forumPost) && is_finite(intval($forumPost))) {
                $forumPost = ForumPost::where('id', intval($forumPost))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forumPost)) {
                $forumPost = ForumPost::where('name', $forumPost)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forumPost instanceof ForumPost) {
                return ($this->forumPosts()->save($forumPost)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given forum post
     *
     * @param App\Models\System\ForumPost|int|string $forumPost
     *
     * @return bool
     * @access public
     */
    public function unassignForumPost($forumPost): bool
    {
        if ($this->hasForumPost($forumPost)) {
            if (is_numeric($forumPost) && is_finite(intval($forumPost))) {
                $forumPost = $this->forumPosts()->where('id', intval($forumPost))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forumPost)) {
                $forumPost = $this->forumPosts()->where('name', $forumPost)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forumPost instanceof ForumPost) {
                return ($this->forumPosts()->detach($forumPost->id)) ? true : false;
            }
        }

        return false;
    }
}
