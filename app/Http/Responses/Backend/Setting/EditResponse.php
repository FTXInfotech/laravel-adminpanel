<?php

namespace App\Http\Responses\Backend\Setting;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Settings\Setting
     */
    protected $setting;

    /**
     * @param \App\Models\Settings\Setting $setting
     */
    public function __construct($setting)
    {
        $this->setting = $setting;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.settings.edit')
            ->withSetting($this->setting);
    }
}
