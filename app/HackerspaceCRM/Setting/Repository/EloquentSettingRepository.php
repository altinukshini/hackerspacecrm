<?php

namespace HackerspaceCRM\Setting\Repository;

use HackerspaceCRM\Setting\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentSettingRepository implements SettingRepositoryInterface
{
    /**
     * All Settings
     *
     * @return Collection
     */
    public function getAll()
    {
        return Setting::all();
    }

    /**
     * Get Setting by key.
     *
     * @param $key
     */
    public function byKey($key)
    {
        return Setting::whereKey($key)->first();
    }

    /**
     * Create new Setting
     *
     * @param $attributes
     *
     * @return Setting
     */
    public function create(array $attributes)
    {
        $setting = new Setting();

        $setting->key = $attributes['key'];
        $setting->value = $attributes['value'];

        $setting->save();

        return $setting;
    }

    /**
     * Delete Setting by key
     *
     * @param $key
     */
    public function deleteByKey($key)
    {
        $setting = $this->byKey($key);

        $setting->delete();
    }

    /**
     * Update Setting with given attributes
     *
     * @param Setting
     * @param value
     *
     * @return void
     */
    // Not limiting it to only single string value as attribute
    // for updating a setting, in the future there could be more
    // columns in the db for one setting rather than just key & value
    public function update(Setting $setting, array $attributes)
    {
        $setting->update($attributes);
    }
}
