<?php
namespace App\Api\V1\Requests;
use Config;
use Dingo\Api\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Config::get('api_validation.forgotpassword.rules');
    }
    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages(){
         return[
            'email.required' =>  trans('validation.api.login.email_required'),
            'email.email' =>  trans('validation.api.login.valid_email'),
         ]; 
    }
}
