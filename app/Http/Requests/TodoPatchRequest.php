<?php

namespace App\Http\Requests;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoPatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::where('api_token', $this->bearerToken())->first();
        $todo = Todo::find($this->id);
        return ($user && $user['id'] == $todo['user_id'] ); // Admin or owner
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'nullable|string|min:1|max:70',
            'descriptions'  => 'nullable|string',
            'completed'     => 'nullable|boolean',
            'tags'          => 'nullable|string|min:2'
        ];
    }

    protected function failedAuthorization()
    {

        throw new HttpResponseException(
            response([
                'error' => 'Permission denied'
            ], 403)
        );

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
