<?php

namespace App\Repositories\Backend\Settings;

use App\Exceptions\GeneralException;
use App\Models\Settings\Setting;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

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
     * Site Logo Path.
     *
     * @var string
     */
    protected $site_logo_path;

    /**
     * Favicon path.
     *
     * @var string
     */
    protected $favicon_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->site_logo_path = 'img'.DIRECTORY_SEPARATOR.'logo'.DIRECTORY_SEPARATOR;
        $this->favicon_path = 'img'.DIRECTORY_SEPARATOR.'favicon'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * @param \App\Models\Settings\Setting $setting
     * @param array                        $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function update(Setting $setting, array $input)
    {
        if (!empty($input['logo'])) {
            $this->removeLogo($setting, 'logo');

            $input['logo'] = $this->uploadLogo($setting, $input['logo'], 'logo');
        }

        if (!empty($input['favicon'])) {
            $this->removeLogo($setting, 'favicon');

            $input['favicon'] = $this->uploadLogo($setting, $input['favicon'], 'favicon');
        }

        if ($setting->update($input)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.settings.update_error'));
    }

    /*
     * Upload logo image
     */
    public function uploadLogo($setting, $logo, $type)
    {
        $path = $type == 'logo' ? $this->site_logo_path : $this->favicon_path;

        $image_name = time().$logo->getClientOriginalName();

        $this->storage->put($path.$image_name, file_get_contents($logo->getRealPath()));

        return $image_name;
    }

    /*
     * remove logo or favicon icon
     */
    public function removeLogo(Setting $setting, $type)
    {
        $path = $type == 'logo' ? $this->site_logo_path : $this->favicon_path;

        if ($setting->$type && $this->storage->exists($path.$setting->$type)) {
            $this->storage->delete($path.$setting->$type);
        }

        $result = $setting->update([$type => null]);

        if ($result) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.settings.update_error'));
    }
}
