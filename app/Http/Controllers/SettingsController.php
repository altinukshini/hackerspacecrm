<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateGeneralSettingsRequest;

use HackerspaceCRM\Setting\Setting;
use HackerspaceCRM\Setting\SettingApplicationService;
use HackerspaceCRM\Setting\Repository\SettingRepositoryInterface;

class SettingsController extends Controller
{

    private $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;

        $this->middleware('auth');
        $this->middleware('permission:setting_update');
    }

    /**
     * Update an existing setting
     *
     * @param App\Http\Requests\UpdateGeneralSettingsRequest
     * @param menuId
     */
    public function editGeneral(UpdateGeneralSettingsRequest $request)
    {
        $settingApplicationService = new SettingApplicationService();
        $requestArray = $request->all();

        if (!array_key_exists( 'enable_registration' , $requestArray )) {
            $requestArray['enable_registration'] = '0';
        }

        foreach ($requestArray as $key => $value) {
            if ($key != '_method' && $key != '_token' ) {
                $setting = $this->settingRepository->byKey($key);
                $settingApplicationService->update($setting, ['value' => $value]);
            }
        }

        Flash::success('Settings updated successfully');

        return back();
    }

    public function showGeneral()
    {
        $settings = $this->settingRepository->getAll()->lists('value', 'key')->toArray();

        return view('settings.general', compact('settings'));
    }

}
