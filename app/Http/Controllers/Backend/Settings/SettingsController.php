<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\Settings\Setting;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Settings\SettingsRepository;
use App\Http\Requests\Backend\Settings\ManageSettingsRequest;
use App\Http\Requests\Backend\Settings\UpdateSettingsRequest;
use Illuminate\Http\Request;

/**
 * Class SettingsController.
 */
class SettingsController extends Controller
{
    /**
     * @var SettingsRepository
     */
    protected $settings;

    /**
     * @param SettingsRepository $settings
     */
    public function __construct(SettingsRepository $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param Setting          $setting
     * @param ManageEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function edit(Setting $setting, ManageSettingsRequest $request)
    {
        return view('backend.settings.edit')
            ->withSetting($setting);
        }
    /**
     * @param Setting          $setting
     * @param UpdateEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function update(Setting $setting, UpdateSettingsRequest $request)
    {
        $this->settings->update($setting, $request->all());
        return redirect()->route('admin.settings.edit', $setting->id)->withFlashSuccess(trans('alerts.backend.settings.updated'));
    }

     /**
     * @param Setting          $setting
     * @param Request $request
     * Remove logo or favicon icon
     *
     * @return mixed
     */
    public function removeIcon(Request $request) {
      
        $this->settings->removeicon($request->data);
        return json_encode(
        array(
                    'status' => true
                )
        );
    }
}