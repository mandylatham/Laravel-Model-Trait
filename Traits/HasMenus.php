<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Menu;

/**
 * Has Menus Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasMenus
{
    /**
     * Returns all menus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    /**
     * Determins if has any menu
     *
     * @return bool
     * @access public
     */
    public function hasMenus(): bool
    {
        return ($this->menus()->count()) ? true : false;
    }

    /**
     * Determines if has the given menu item
     *
     * @param App\Model\Menu|int|string $menu
     *
     * @return bool
     * @access public
     */
    public function hasMenu($menu): bool
    {
        if (filled($menu)) {
            if (is_numeric($menu) && is_finite(intval($menu))) {
                $menu = Menu::where('id', intval($menu))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($menu)) {
                $menu = Menu::where('name', $menu)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($menu instanceof Menu) {
                return $this->menus()->where('id', $menu->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign the given menu
     *
     * @param  App\Model\Menu|int|string $menu
     * @return bool
     * @access public
     */
    public function assignMenu($menu): bool
    {
        if (!$this->hasMenu($menu)) {
            if (is_numeric($menu) && is_finite(intval($menu))) {
                $menu = Menu::where('id', intval($menu))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($menu)) {
                $menu = Menu::where('name', $menu)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($menu instanceof Menu) {
                return ($this->menus()->save($menu)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign the given menu
     *
     * @param  App\Model\Menu|int|string $menu
     * @return bool
     * @access public
     */
    public function unassignMenu($menu): bool
    {
        if ($this->hasMenu($menu)) {
            if (is_numeric($menu) && is_finite(intval($menu))) {
                $menu = Menu::where('id', intval($menu))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($menu)) {
                $menu = Menu::where('name', $menu)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($menu instanceof Menu) {
                return ($this->menus()->detach($menu->id)) ? true : false;
            }
        }

        return false;
    }
}
