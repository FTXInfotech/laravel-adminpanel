<?php

namespace App\Http\Requests\Backend\Settings;

use App\Http\Requests\Request;
use App\Models\Settings\Setting;

/**
 * Class UpdateSettingsRequest.
 */
class UpdateSettingsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-settings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data           = Setting::find(1);
        $checkLogo      = $data->logo;
        $checkFavicon   = $data->favicon;
        if(!empty($checkLogo)){
            $logoValidation = 'image|dimensions:min_width=226,min_height=48';
        }else{
            $logoValidation = 'required|image|dimensions:min_width=226,min_height=48';
        }
        if(!empty($checkFavicon)){
            $faviconValidation = 'mimes:jpg,jpeg,png,ico|dimensions:width=16,height=16';
        }else{
            $faviconValidation = 'required|mimes:jpg,jpeg,png,ico|dimensions:width=16,height=16';
        }
        return [
            'logo' => $logoValidation,
            'favicon' => $faviconValidation,
            'from_name' =>  'required',
            'from_email' =>  'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'logo.dimensions' => 'Invalid logo - should be minimum 226*48',
            'favicon.dimensions' => 'Invalid icon - should be 16*16',
            'logo.required'    =>  'The logo field is required in seo settings.',
            'favicon.required'    =>  'The favicon field is required in seo settings.',
            'from_name.required'    =>  'The from name field is required in mail settings.',
            'from_email.required'    =>  'The from email field is required in mail settings.',
        ];
    }
     
}
