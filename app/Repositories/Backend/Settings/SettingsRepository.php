<?php

namespace App\Repositories\Backend\Settings;

use App\Exceptions\GeneralException;
use App\Models\Settings\Setting;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class SettingsRepository.
 */
class SettingsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Setting::class;

    /**
     * @param \App\Models\Settings\Setting $setting
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(Setting $setting, array $input)
    {
        if (isset($input['logo'])) {
            $image_upload = $this->uploadlogoimage($setting, $input['logo']);
            $input['logo'] = $image_upload;
        }

        if (isset($input['favicon'])) {
            $image_upload = $this->uploadfaviconimage($setting, $input['favicon']);
            $input['favicon'] = $image_upload;
        }

        if ($setting->update($input)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.settings.update_error'));
    }

    /*
     * Upload logo image
     */
    public function uploadlogoimage($setting, $logo)
    {
        $image_name_ex = $logo->getClientOriginalExtension();

        if ($setting->logo) {
            if (file_exists(public_path().'/img/site_logo/'.$setting->logo)) {
                unlink('img/site_logo/'.$setting->logo);
            }
        }

        $image_name = time().$logo->getClientOriginalName();
        $destinationPath = public_path('img/site_logo');
        $logo->move($destinationPath, $image_name);

        return $image_name;
    }

    /*
     * Upload favicon icon image
     */
    public function uploadfaviconimage($setting, $logo)
    {
        $image_name_ex = $logo->getClientOriginalExtension();

        if ($setting->favicon) {
            if (file_exists(public_path().'/img/favicon_icon/'.$setting->favicon)) {
                unlink('img/favicon_icon/'.$setting->favicon);
            }
        }

        $image_name = time().$logo->getClientOriginalName();
        $destinationPath = public_path('/img/favicon_icon');
        $logo->move($destinationPath, $image_name);

        return $image_name;
    }

    /*
     * remove logo or favicon icon
     */
    public function removeicon($input)
    {
        $setting = $this->query()->get();
        if ($input == 'logo') {
            if ($setting[0]->logo) {
                if (file_exists(public_path().'/img/site_logo/'.$setting[0]->logo)) {
                    unlink('img/site_logo/'.$setting[0]->logo);
                }
                $this->query()->update(['logo' => null]);
            }
        } else {
            if ($setting[0]->favicon) {
                if (file_exists(public_path().'/img/favicon_icon/'.$setting[0]->favicon)) {
                    unlink('img/favicon_icon/'.$setting[0]->favicon);
                }
            }
            $this->query()->update(['favicon' => null]);
        }
    }
}
