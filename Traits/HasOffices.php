<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Office;

/**
 * Has Offices Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasOffices
{
    /**
     * Gets offices
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function offices()
    {
        return $this->belongsToMany(Office::class);
    }

    /**
     * Checks if has any office
     *
     * @return bool
     * @access public
     */
    public function hasOffices(): bool
    {
        return ($this->offices->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given office
     *
     * @param App\Models\System\Office|int|string $office
     *
     * @return bool
     * @access public
     */
    public function hasOffice($office): bool
    {
        if (filled($office)) {
            if (is_numeric($office) && is_finite(intval($office))) {
                return $this->offices()->where('id', intval($office))->exists();
            }

            if (is_string($office)) {
                return $this->offices()->where('name', $office)->exists();
            }

            if ($office instanceof Office) {
                return $this->offices()->where('id', $office->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given office
     *
     * @param App\Models\System\Office|int|string $office
     *
     * @return bool
     * @access public
     */
    public function assignOffice($office): bool
    {
        if (!$this->hasOffice($office)) {
            if (is_numeric($office) && is_finite(intval($office))) {
                $office = Office::where('id', intval($office))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($office)) {
                $office = Office::where('name', $office)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($office instanceof Office) {
                return ($this->offices()->save($office)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given office
     *
     * @param App\Models\System\Office|int|string $office
     *
     * @return bool
     * @access public
     */
    public function unassignOffice($office): bool
    {
        if ($this->hasOffice($office)) {
            if (is_numeric($office) && is_finite(intval($office))) {
                $office = $this->offices()->where('id', intval($office))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($office)) {
                $office = $this->offices()->where('name', $office)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($office instanceof Office) {
                return ($this->offices()->detach($office->id)) ? true : false;
            }
        }

        return false;
    }
}
