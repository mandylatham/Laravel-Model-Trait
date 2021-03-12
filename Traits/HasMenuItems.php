<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\MenuItem;

/**
 * Has Menu Items Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasMenuItems
{
    /**
     * Returns all menu items
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class);
    }

    /**
     * Determins if has any menu items
     *
     * @return bool
     * @access public
     */
    public function hasMenuItems(): bool
    {
        return ($this->menuItems()->count()) ? true : false;
    }

    /**
     * Determines if has the given menu item
     *
     * @param App\Model\MenuItem|int|string $menuItem
     *
     * @return bool
     * @access public
     */
    public function hasMenuItem($menuItem): bool
    {
        if (filled($menuItem)) {
            if (is_numeric($menuItem) && is_finite(intval($menuItem))) {
                $menuItem = MenuItem::where('id', intval($menuItem))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($menuItem)) {
                $menuItem = MenuItem::where('name', $menuItem)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($menuItem instanceof MenuItem) {
                return $this->menuItems()->where('id', $menuItem->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign the given menu
     *
     * @param  App\Model\MenuItem|int|string $menuItem
     * @return bool
     * @access public
     */
    public function assignMenuItem($menuItem): bool
    {
        if (!$this->hasMenuItem($menuItem)) {
            if (is_numeric($menuItem) && is_finite(intval($menuItem))) {
                $menuItem = MenuItem::where('id', intval($menuItem))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($menuItem)) {
                $menuItem = MenuItem::where('name', $menuItem)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($menuItem instanceof MenuItem) {
                return ($this->menuItems()->save($menuItem)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign the given menu
     *
     * @param  App\Model\MenuItem|int|string $menuItem
     * @return bool
     * @access public
     */
    public function unassignMenuItem($menuItem): bool
    {
        if ($this->hasMenuItem($menuItem)) {
            if (is_numeric($menuItem) && is_finite(intval($menuItem))) {
                $menuItem = MenuItem::where('id', intval($menuItem))
                    ->select(['id'])
                    ->firstOrFail();
            } elseif (is_string($menuItem)) {
                $menuItem = MenuItem::where('name', $menuItem)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($menuItem instanceof MenuItem) {
                return ($this->menuItems()->detach($menuItem->id)) ? true : false;
            }
        }

        return false;
    }
}
