<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Folder;

/**
 * Has Folders Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasFolders
{
    /**
     * Gets folders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function folders()
    {
        return $this->belongsToMany(Folder::class);
    }

    /**
     * Checks if has any folder
     *
     * @return bool
     * @access public
     */
    public function hasFolders(): bool
    {
        return ($this->folders->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given folder
     *
     * @param App\Models\System\Folder|int|string $folder
     *
     * @return bool
     * @access public
     */
    public function hasFolder($folder): bool
    {
        if (filled($folder)) {
            if (is_numeric($folder) && is_finite(intval($folder))) {
                return $this->folders()->where('id', intval($folder))->exists();
            }

            if (is_string($folder)) {
                return $this->folders()->where('name', $folder)->exists();
            }

            if ($folder instanceof Folder) {
                return $this->folders()->where('id', $folder->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given folder
     *
     * @param App\Models\System\Folder|int|string $folder
     *
     * @return bool
     * @access public
     */
    public function assignFolder($folder): bool
    {
        if (!$this->hasFolder($folder)) {
            if (is_numeric($folder) && is_finite(intval($folder))) {
                $folder = Folder::where('id', intval($folder))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($folder)) {
                $folder = Folder::where('name', $folder)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($folder instanceof Folder) {
                return ($this->folders()->save($folder)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given folder
     *
     * @param App\Models\System\Folder|int|string $folder
     *
     * @return bool
     * @access public
     */
    public function unassignFolder($folder): bool
    {
        if ($this->hasFolder($folder)) {
            if (is_numeric($folder) && is_finite(intval($folder))) {
                $folder = $this->folders()->where('id', intval($folder))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($folder)) {
                $folder = $this->folders()->where('name', $folder)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($folder instanceof Folder) {
                return ($this->folders()->detach($folder->id)) ? true : false;
            }
        }

        return false;
    }
}
