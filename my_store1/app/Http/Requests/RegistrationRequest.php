<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // RegistrationRequest.php

    public function authorize()
    {
        return true;  // Set this to "true" else Unauthorized error will be thrown
    }

    public function rules()
    {
        return [
            'name'      => ['required', 'min:3'],
            'email'     => ['required', 'string', 'email'],
            'password'  => ['required', 'string', 'min:6'],
        ];
    }
}
