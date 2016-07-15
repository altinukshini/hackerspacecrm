<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use HackerspaceCRM\Setting\Setting;
use App\Http\Requests\UpdateGeneralSettingsRequest;
use HackerspaceCRM\Setting\SettingApplicationService;
use HackerspaceCRM\Setting\Repository\SettingRepositoryInterface;

class SettingsController extends Controller
{

    /**
     * Instance of HackerspaceCRM\Setting\Repository\SettingRepositoryInterface
     *
     * @var Object
     */
    private $settingRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;

        $this->middleware('auth');
        $this->middleware('permission:setting_view');
    }

    /**
     * Update an existing setting
     *
     * @param App\Http\Requests\UpdateGeneralSettingsRequest
     * @param menuId
     */
    public function updateGeneralSettings(UpdateGeneralSettingsRequest $request)
    {

        $settingApplicationService = new SettingApplicationService();
        $requestArray = $request->all();

        if (!array_key_exists( 'enable_registration' , $requestArray )) {
            $requestArray['enable_registration'] = '0';
        }

        foreach ($requestArray as $key => $value) {
            if ($key != '_method' && $key != '_token' ) {
                $setting = $this->settingRepository->byKey($key);
                if (!is_null($setting)) {
                    $settingApplicationService->update($setting, ['value' => $value]);
                }
            }
        }

        Flash::success('Settings updated successfully');

        return back();
    }

    /**
     * Show general settings in /settings/general
     *
     * @return View;
     **/
    public function showGeneralSettingsForm()
    {
        $settings = $this->settingRepository->getAll()->lists('value', 'key')->toArray();

        return view('settings.general', compact('settings'));
    }

}
