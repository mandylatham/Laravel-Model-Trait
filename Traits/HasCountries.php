<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Country;

/**
 * Has Countries Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasCountries
{
    /**
     * Returns all related resource
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }

    /**
     * Determines if has any resource
     *
     * @return bool
     * @access public
     */
    public function hasCountries()
    {
        return ($this->countries()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given resource
     *
     * @param App\Models\System\Country|int $country
     *
     * @return bool
     * @access public
     */
    public function hasCountry($country): bool
    {
        if (filled($country)) {
            if (is_numeric($country) && is_finite(intval($country))) {
                return $this->countries()->where('id', intval($country))->exists();
            }

            if ($country instanceof Country) {
                return $this->countries()->where('id', $country->id)->exists();
            }
        }

        return false;
    }


    /**
     * Assigns a given resource
     *
     * @param App\Models\System\Country|int $country
     *
     * @return bool
     * @access public
     */
    public function assignCountry($country): bool
    {
        if (!$this->hasCountry($country)) {
            if (is_numeric($country) && is_finite(intval($country))) {
                $country = Country::where('id', intval($country))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($country instanceof Country) {
                return ($this->countries()->save($country)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given resource
     *
     * @param App\Models\System\Country|int $country
     *
     * @return bool
     * @access public
     */
    public function unassignCountry($country): bool
    {
        if ($this->hasCountry($country)) {
            if (is_numeric($country) && is_finite(intval($country))) {
                return ($this->countries()->detach(intval($country))) ? true : false;
            }

            if ($country instanceof Country) {
                return ($this->countries()->detach($country->id)) ? true : false;
            }
        }

        return true;
    }
}
