<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;

class ElectricianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $email= ['required', 'string', 'email', 'max:255', 'unique:'.User::class];
        if (request()->id > 0) {
            $id = request()->id;
            $email= ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id];
        }
        return [
            'name' =>  ['required', 'string', 'max:255'],
            'work_experience' =>  ['required'],
            'state_id' =>  ['required'],
            'number' => ['required', 'digits:10'],
            'email' => $email,
            'profile' => ['mimes:jpeg,jpg,png,gif|max:10000'],
        ];
    }
}
