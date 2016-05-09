<?php

namespace HackerspaceCRM\Setting\Repository;

use HackerspaceCRM\Setting\Setting;

interface SettingRepositoryInterface
{
    public function getAll();
    public function byKey($key);
 
    public function create(array $attributes);
    public function deleteByKey($key);
    public function update(Setting $setting, array $attributes);
}
