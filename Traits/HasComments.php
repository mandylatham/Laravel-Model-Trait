<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Comment;

/**
 * Has Attachments Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasComments
{
    /**
     * Returns all comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }

    /**
     * Determines if has any comments
     *
     * @return bool
     * @access public
     */
    public function hasComments()
    {
        return ($this->comments()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given comment
     *
     * @param App\Models\System\Comment|int $comment
     *
     * @return bool
     * @access public
     */
    public function hasComment($comment): bool
    {
        if (filled($comment)) {
            if (is_numeric($comment) && is_finite(intval($comment))) {
                return $this->comments()->where('id', intval($comment))->exists();
            }

            if ($comment instanceof Comment) {
                return $this->comments()->where('id', $comment->id)->exists();
            }
        }

        return false;
    }


    /**
     * Assigns a given comment
     *
     * @param App\Models\System\Comment|int $comment
     *
     * @return bool
     * @access public
     */
    public function assignComment($comment): bool
    {
        if (!$this->hasComment($comment)) {
            if (is_numeric($comment) && is_finite(intval($comment))) {
                $comment = Post::where('id', intval($comment))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($comment instanceof Comment) {
                return ($this->comments()->save($comment)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given comment
     *
     * @param App\Models\System\Comment|int $comment
     *
     * @return bool
     * @access public
     */
    public function unassignComment($comment): bool
    {
        if ($this->hasComment($comment)) {
            if (is_numeric($comment) && is_finite(intval($comment))) {
                return ($this->comments()->detach(intval($comment))) ? true : false;
            }

            if ($comment instanceof Comment) {
                return ($this->comments()->detach($comment->id)) ? true : false;
            }
        }

        return true;
    }
}
