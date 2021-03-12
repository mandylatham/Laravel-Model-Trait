<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Setting;

/**
 * Has Settings Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasSettings
{
    /**
     * Gets Settings Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function settings()
    {
        return $this->belongsToMany(Setting::class);
    }

    /**
     * Determines if has any settings
     *
     * @return bool
     * @access public
     */
    public function hasSettings(): bool
    {
        return ($this->settings()->count()) ? true : false;
    }

    /**
     * Determines if the given setting
     *
     * @param  App\Models\System\Setting|int|string $setting
     * @return bool
     * @access public
     */
    public function hasSetting($setting): bool
    {
        if (filled($setting)) {
            if (is_numeric($setting) && is_finite(intval($setting))) {
                $setting = Setting::where('id', intval($setting))
                    ->select(['id'])
                    ->first();
            }

            if (is_string($setting)) {
                $setting = Setting::where('key', trim($setting))
                    ->select(['id'])
                    ->first();
            }

            if ($setting instanceof Setting) {
                return $this->settings()->where('id', $setting->id)->exists();
            }
        }

        return false;
    }

    /**
     * Get a single setting
     *
     * @param  App\Models\System\Setting|int|string $setting
     * @return App\Models\System\Setting|null
     */
    public function getSetting($setting): ?Setting
    {
        if (filled($setting)) {
            if (is_numeric($setting) && is_finite(intval($setting))) {
                $setting = Setting::where('id', intval($setting))
                              ->first();
            }

            if (is_string($setting)) {
                $setting = Setting::where('key', trim($setting))
                                  ->first();
            }

            if ($setting instanceof Setting) {
                return $setting;
            }
        }

        return null;
    }

    /**
     * Assign the given setting
     *
     * @param  App\Models\System\Setting|int $setting
     * @return bool
     * @access public
     */
    public function assignSetting($setting): bool
    {
        if (!$this->hasSetting($setting)) {
            if (is_numeric($setting) && is_finite(intval($setting))) {
                $setting = Setting::where('id', intval($setting))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($setting instanceof Setting) {
                return ($this->settings()->save($setting)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign the given setting
     *
     * @param  App\Models\System\Setting|int $setting
     * @return bool
     * @access public
     */
    public function unassignSetting($setting): bool
    {
        if ($this->hasSetting($setting)) {
            if (is_numeric($setting) && is_finite(intval($setting))) {
                $setting = Setting::where('id', intval($setting))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($setting instanceof Setting) {
                return ($this->settings()->detach($setting->id)) ? true : false;
            }
        }

        return false;
    }
}
