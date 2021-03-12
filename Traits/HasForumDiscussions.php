<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\ForumDiscussion;

/**
 * Has Forum Discuissions Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasForumDiscussions
{
    /**
     * Gets Forum Discussions Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function forumDiscussions()
    {
        return $this->belongsToMany(ForumDiscussion::class);
    }

    /**
     * Checks if has any forum discussion
     *
     * @return bool
     * @access public
     */
    public function hasForumDiscussions(): bool
    {
        return ($this->forumDiscussions->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given forum discuission
     *
     * @param App\Models\System\ForumDiscussion|int|string $forumDiscussion
     *
     * @return bool
     * @access public
     */
    public function hasForumDiscussion($forumDiscussion): bool
    {
        if (filled($forumDiscussion)) {
            if (is_numeric($forumDiscussion) && is_finite(intval($forumDiscussion))) {
                return $this->forumDiscussions()->where('id', intval($forumDiscussion))->exists();
            }

            if (is_string($forumDiscussion)) {
                return $this->forumDiscussions()->where('name', $forumDiscussion)->exists();
            }

            if ($forumDiscussion instanceof ForumDiscussion) {
                return $this->forumDiscussions()->where('id', $forumDiscussion->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given forum discussion
     *
     * @param App\Models\System\ForumDiscussion|int|string $forumDiscussion
     *
     * @return bool
     * @access public
     */
    public function assignForumDiscussion($forumDiscussion): bool
    {
        if (!$this->hasForumDiscussion($forumDiscussion)) {
            if (is_numeric($forumDiscussion) && is_finite(intval($forumDiscussion))) {
                $forumDiscussion = ForumDiscussion::where('id', intval($forumDiscussion))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forumDiscussion)) {
                $forumDiscussion = ForumDiscussion::where('name', $forumDiscussion)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forumDiscussion instanceof ForumDiscussion) {
                return ($this->forumDiscussions()->save($forumDiscussion)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given forum discussion
     *
     * @param App\Models\System\ForumDiscussion|int|string $forumDiscussion
     *
     * @return bool
     * @access public
     */
    public function unassignForumDiscussion($forumDiscussion): bool
    {
        if ($this->hasForumDiscussion($forumDiscussion)) {
            if (is_numeric($forumDiscussion) && is_finite(intval($forumDiscussion))) {
                $forumDiscussion = $this->forumDiscussions()->where('id', intval($forumDiscussion))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($forumDiscussion)) {
                $forumDiscussion = $this->forumDiscussions()->where('name', $forumDiscussion)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($forumDiscussion instanceof ForumDiscussion) {
                return ($this->forumDiscussions()->detach($forumDiscussion->id)) ? true : false;
            }
        }

        return false;
    }
}
