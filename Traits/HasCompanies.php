<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Company;

/**
 * Has Companies Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasCompanies
{
    /**
     * Returns all resources
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * Determines if has any resources
     *
     * @return bool
     * @access public
     */
    public function hasCompanies(): bool
    {
        return ($this->companies->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given resource
     *
     * @param App\Models\Tenants\Company|int $company
     *
     * @return bool
     * @access public
     */
    public function hasCompany($company): bool
    {
        if (filled($company)) {
            if (is_numeric($company) && is_finite(intval($company))) {
                return $this->companies()->where('id', intval($company))->exists();
            }

            if ($company instanceof Company) {
                return $this->companies()->where('id', $company->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given resource
     *
     * @param App\Models\Tenants\Company|int $company
     *
     * @return bool
     * @access public
     */
    public function assignCompany($company): bool
    {
        if (!$this->hasCompany($company)) {
            if (is_numeric($company) && is_finite(intval($company))) {
                $company = Company::where('id', intval($company))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($company instanceof Company) {
                return ($this->companies()->save($company)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given resource
     *
     * @param App\Models\Tenants\Company|int $company
     *
     * @return bool
     * @access public
     */
    public function unassignCompany($company): bool
    {
        if ($this->hasCompany($company)) {
            if (is_numeric($company) && is_finite(intval($company))) {
                return ($this->companies()->detach(intval($company))) ? true : false;
            }

            if ($company instanceof Company) {
                return ($this->companies()->detach($company->id)) ? true : false;
            }
        }

        return true;
    }
}
