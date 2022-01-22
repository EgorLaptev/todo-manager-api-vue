<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where('api_token', $this->bearerToken())->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|string|min:1|max:70',
            'description'   => 'nullable|string',
            'tags'          => 'nullable|string|min:2'
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

    protected function failedAuthorization()
    {

        throw new HttpResponseException(
            response([
                'error' => 'Permission denied'
            ], 422)
        );

    }

}
