<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UserStoreRequest extends FormRequest
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
            'name'                  => 'required|string|max:75|min:2',
            'email'                 => 'required|string|email|unique:users,email',
            'password'              => 'required|string|confirmed',
            'password_confirmation' => 'required|string'
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            response([
                'errors' => $validator->errors()
            ], 422)
        );

    }

}
