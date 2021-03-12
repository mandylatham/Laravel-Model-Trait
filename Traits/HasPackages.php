<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Package;

/**
 * Has Packages Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasPackages
{
    /**
     * Returns packages model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    /**
     * Determines if has any package
     *
     * @return bool
     * @access public
     */
    public function hasPackages(): bool
    {
        return ($this->packages()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given package
     *
     * @param  App\Models\System\Package|int $package
     * @return bool
     * @access public
     */
    public function hasPackage($package): bool
    {
        if (filled($package)) {
            if (is_numeric($package) && is_finite(intval($package))) {
                return $this->packages()->where('id', intval($package))->exists();
            }

            if ($package instanceof Package) {
                return $this->packages()->where('id', $package->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given package
     *
     * @param  App\Models\System\Package|int $package
     * @return bool
     * @access public
     */
    public function assignPackage($package): bool
    {
        if (!$this->hasPackage($package)) {
            if (is_numeric($package) && is_finite(intval($package))) {
                $package = Package::where('id', intval($package))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($package instanceof Package) {
                return ($this->packages()->save($package)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }


    /**
     * Unassign a given package
     *
     * @param  App\Models\System\Package|int $package
     * @return bool
     * @access public
     */
    public function unassignPackage($package): bool
    {
        if ($this->hasPackage($package)) {
            if (is_numeric($package) && is_finite(intval($package))) {
                return ($this->packages()->detach(intval($package))) ? true : false;
            }

            if ($package instanceof Package) {
                return ($this->packages()->detach($package->id)) ? true : false;
            }
        }

        return true;
    }
}
