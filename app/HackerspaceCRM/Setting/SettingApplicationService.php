<?php

namespace HackerspaceCRM\Setting;

use Illuminate\Support\Facades\App;

use HackerspaceCRM\Setting\Setting;
use HackerspaceCRM\Setting\Repository\SettingRepositoryInterface;

class SettingApplicationService
{

    /**
     * Create new setting
     *
     * @return array
     *
     * @return Setting
     **/
    public function create($setting)
    {
        $settingRepository = App::make(SettingRepositoryInterface::class);
        $setting = $settingRepository->create($setting);

        return $setting;
    }

    /**
     * Delete menu by key
     *
     * @param key
     *
     * @return void
     **/
    public function delete($key)
    {
        $settingRepository = App::make(SettingRepositoryInterface::class);
        $settingRepository->deleteByKey($key);
    }

    /**
     * Update setting
     *
     * @param Setting
     * @param array attributes
     *
     * @return void
     **/
    public function update(Setting $setting, array $attributes)
    {
        $settingRepository = App::make(SettingRepositoryInterface::class);
        $settingRepository->update($setting, $attributes);
    }
}
