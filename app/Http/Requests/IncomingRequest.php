<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required',
            'amount'        => 'required',
            'type'          => 'nullable',
            // 'invoice_id'    => 'nullable',
            'due'           => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Trebuie completat numele clientului',
            'amount.required'        => 'Trebuie completata valoarea incasarii',
        ];
    }

}
