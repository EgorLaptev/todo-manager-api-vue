<?php

namespace App\Http\Requests;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoDestroyRequest extends FormRequest
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
            //
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


}
