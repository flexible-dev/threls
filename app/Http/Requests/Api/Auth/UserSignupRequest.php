<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserSignupRequest extends FormRequest
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
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'unique:users'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:50'
            ]
        ];
    }

    protected function prepareForValidation() {
        $req = $this->all();

        // Convert all emails to lower case for clarification
        $req['email'] = strtolower($req['email']??"");

        $this->merge($req);
    }
}
