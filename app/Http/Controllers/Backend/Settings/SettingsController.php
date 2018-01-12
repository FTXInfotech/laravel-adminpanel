<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Settings\ManageSettingsRequest;
use App\Http\Requests\Backend\Settings\UpdateSettingsRequest;
use App\Models\Settings\Setting;
use App\Repositories\Backend\Settings\SettingsRepository;

/**
 * Class SettingsController.
 */
class SettingsController extends Controller
{
    protected $settings;

    /**
     * @param \App\Repositories\Backend\Settings\SettingsRepository $settings
     */
    public function __construct(SettingsRepository $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param \App\Models\Settings\Setting                              $setting
     * @param \App\Http\Requests\Backend\Settings\ManageSettingsRequest $request
     *
     * @return mixed
     */
    public function edit(Setting $setting, ManageSettingsRequest $request)
    {
        return view('backend.settings.edit')
            ->withSetting($setting);
    }

    /**
     * @param \App\Models\Settings\Setting                              $setting
     * @param \App\Http\Requests\Backend\Settings\UpdateSettingsRequest $request
     *
     * @return mixed
     */
    public function update(Setting $setting, UpdateSettingsRequest $request)
    {
        $this->settings->update($setting, $request->except(['_token', '_method']));

        return redirect()
            ->route('admin.settings.edit', $setting->id)
            ->with('flash_success', trans('alerts.backend.settings.updated'));
    }
}
