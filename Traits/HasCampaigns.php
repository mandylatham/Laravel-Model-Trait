<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Campaign;

/**
 * Has Campaigns Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasCampaigns
{
    /**
     * Returns all
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }

    /**
     * Determines if has a given resource
     *
     * @return bool
     * @access public
     */
    public function hasCampaigns(): bool
    {
        return ($this->campaigns()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given resource
     *
     * @param App\Models\System\Campaign|int $campaign
     *
     * @return bool
     * @access public
     */
    public function hasCampaign($campaign): bool
    {
        if (filled($campaign)) {
            if (is_numeric($campaign) && is_finite(intval($campaign))) {
                return $this->campaigns()->where('id', intval($campaign))->exists();
            }

            if ($campaign instanceof Campaign) {
                return $this->campaigns()->where('id', $campaign->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given resource
     *
     * @param App\Models\System\Campaign|int $campaign
     *
     * @return bool
     * @access public
     */
    public function assignCampaign($campaign): bool
    {
        if (!$this->hasCampaign($campaign)) {
            if (is_numeric($campaign) && is_finite(intval($campaign))) {
                $campaign = Campaign::where('id', intval($campaign))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($campaign instanceof Campaign) {
                return ($this->campaigns()->save($campaign)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given resource
     *
     * @param App\Models\System\Campaign|int $campaign
     *
     * @return bool
     * @access public
     */
    public function unassignCampaign($campaign): bool
    {
        if ($this->hasCampaign($campaign)) {
            if (is_numeric($campaign) && is_finite(intval($campaign))) {
                return ($this->campaigns()->detach(intval($campaign))) ? true : false;
            }

            if ($campaign instanceof Campaign) {
                return ($this->campaigns()->detach($campaign->id)) ? true : false;
            }
        }

        return true;
    }
}
