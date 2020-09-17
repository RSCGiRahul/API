<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
        return [
            'fb_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            
        ];
    }


        /**
         * Prepare the data for validation.
         *
         * @return void
         */
        protected function prepareForValidation()
        {
            $this->merge([
                'username' => $this->first_name.rand(),
                "action" => "login",
            ]);
        }
}
