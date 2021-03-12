<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Post;

/**
 * Has Posts Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasPosts
{
    /**
     * Gets Credentials
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Determines if has any posts
     *
     * @return bool
     * @access public
     */
    public function hasPosts(): bool
    {
        return ($this->posts->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given post
     *
     * @param  App\Models\System\Post|int $post
     * @return bool
     * @access public
     */
    public function hasPost($post): bool
    {
        if (filled($post)) {
            if (is_numeric($post) && is_finite(intval($post))) {
                $post = Post::where('id', intval($post))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($post instanceof Post) {
                return $this->posts()->where('id', $post->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assigns a given post
     *
     * @param  App\Models\System\Post|int $post
     * @return bool
     * @access public
     */
    public function assignPost($post): bool
    {
        if (!$this->hasPost($post)) {
            if (is_numeric($post) && is_finite(intval($post))) {
                $post = Post::where('id', intval($post))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($post instanceof Post) {
                return ($this->posts()->save($post)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given post
     *
     * @param  App\Models\System\Post|int $post
     * @return bool
     * @access public
     */
    public function unassignPost($post): bool
    {
        if ($this->hasPost($post)) {
            if (is_numeric($post) && is_finite(intval($post))) {
                $post = Post::where('id', intval($post))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($post instanceof Post) {
                return ($this->posts()->detach($post->id)) ? true : false;
            }
        }

        return false;
    }
}
