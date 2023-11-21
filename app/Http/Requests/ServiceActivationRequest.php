<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceActivationRequest extends FormRequest
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
        return [
            'electrician_id'      => ['required','unique:service_activation,electrician_id,'.request()->id],
            'number_of_leads'     => ['required'],
            'service_activation_date'     => ['required'],
            'service_remarks'     => ['required'],
            'payment_amount'      => ['required']
         ];
    }
}
