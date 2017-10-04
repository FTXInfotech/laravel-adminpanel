<?php
namespace App\Api\V1\Requests;
use Config;
use Dingo\Api\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        return Config::get('api_validation.resetpassword.rules');
    }
    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
     public function messages(){
          return[
             'email.required' =>  trans('validation.api.resetpassword.email_required'),
             'email.email' =>  trans('validation.api.resetpassword.valid_email'),
             'password.required' => trans('validation.api.resetpassword.password_required'),
             'password.confirmed' => trans('validation.api.resetpassword.password_confirmed'),
             'token.required' => trans('validation.api.resetpassword.token_required'),
             'password_confirmation.required' => trans('validation.api.resetpassword.confirm_password_required'),
          ]; 
     }
}
