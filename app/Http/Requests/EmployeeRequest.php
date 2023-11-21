<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $passwordRule = ['required', 'confirmed', Rules\Password::defaults()];
        $name =  ['required', 'string', 'max:255'];
        $role_id = ['required'];
        $number = ['required', 'digits:10'];
        $email= ['required', 'string', 'email', 'max:255', 'unique:'.User::class];
        if (request()->id > 0) {
            $id = request()->id;
            $passwordRule = "sometimes";
            $email= ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id];
        }
        return [
            'name' => $name,
            'role_id' => $role_id,
            'number' => $number,
            'email' => $email,
            'password' => $passwordRule,
            'profile' => ['mimes:jpeg,jpg,png,gif|max:10000'],
        ];
    }
}
