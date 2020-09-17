<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class VideoCommentRequest extends FormRequest
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
            'comments' => 'required',
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
                'user_id' => User::where('fb_id', $this->fb_id)->first()->id,
                'body' => $this->comments
            ]);

            // $this->replace([
            //     'body' => $this->comments
            // ]);
        }
}
