<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Redirect;

/**
 * Has Redirects Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasRedirects
{
    /**
     * Returns all blogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function redirects()
    {
        return $this->belongsToMany(Redirect::class);
    }

    /**
     * Checks if has any redirects
     *
     * @return bool
     * @access public
     */
    public function hasRedirects(): bool
    {
        return ($this->redirects()->count() !== 0) ? true : false;
    }

    /**
     * Checks if has a given redirect
     *
     * @param  \App\Models\System\Redirect|int
     * @return bool
     */
    public function hasRedirect($redirect): bool
    {
        if (filled($redirect)) {
            if (is_numeric($redirect) && is_finite(intval($redirect))) {
                return $this->redirects()->where('id', intval($redirect))->exists();
            }

            if ($redirect instanceof Redirect) {
                return $this->redirects()->where('id', $redirect->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assigns a given redirect
     *
     * @param  \App\Models\System\Redirect|int $redirect
     * @return bool
     * @access public
     */
    public function assignRedirect($redirect): bool
    {
        if (!$this->hasRedirect($redirect)) {
            if (is_numeric($redirect) && is_finite(intval($redirect))) {
                $redirect = Redirect::where('id', intval($redirect))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($redirect instanceof Redirect) {
                return ($this->redirects()->save($redirect)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given redirect
     *
     * @param  \App\Models\System\Redirect|int $redirect
     * @return bool
     * @access public
     */
    public function unassignRedirect($redirect): bool
    {
        if ($this->hasRedirect($redirect)) {
            if (is_numeric($redirect) && is_finite(intval($redirect))) {
                $redirect = Redirect::where('id', intval($redirect))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($redirect instanceof Redirect) {
                return ($this->redirects()->detach($redirect->id)) ? true : false;
            }
        }

        return true;
    }
}
