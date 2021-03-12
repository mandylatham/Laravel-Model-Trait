<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Page;

/**
 * Has Pages Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasPages
{
    /**
     * Return give page model relationship
     *
         * @copyright 2020 MdRepTime, LLC
     * @return    \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access    public
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    /**
     * Checks if has any assigned pages
     *
     * @return bool
     */
    public function hasPages(): bool
    {
        return ($this->pages()->count() !== 0) ? true : false;
    }

    /**
     * Determins if has a given page
     *
     * @param  App\Models\System\Page|int $page
     * @return bool
     */
    public function hasPage($page): bool
    {
        if (filled($page)) {
            if (is_numeric($page) && is_finite(intval($page))) {
                return $this->pages()->where('id', intval($page))->exists();
            }

            if ($page instanceof Page) {
                return $this->pages()->where('id', $page->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given page
     *
     * @param  App\Models\System\Page|int $page
     * @return bool
     */
    public function assignPage($page): bool
    {
        if (!$this->hasPage($page)) {
            if (is_numeric($page) && is_finite(intval($page))) {
                $page = Page::where('id', intval($page))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($page instanceof Page) {
                return ($this->pages()->save($page)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given page
     *
     * @param  App\Models\System\Page|int $page
     * @return bool
     */
    public function unassignPage($page): bool
    {
        if ($this->hasPage($page)) {
            if (is_numeric($page) && is_finite(intval($page))) {
                $page = $this->pages()->where('id', intval($page))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($page instanceof Page) {
                return ($this->pages()->detach($page->id)) ? true : false;
            }
        }

        return true;
    }
}
