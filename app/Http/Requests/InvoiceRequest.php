<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'numberInv'     => 'required',
            'amount'        => 'required',
            'rest'          => 'required',
            'dateInv'       => 'required',
            'status'        => 'required',
            'student_id'    => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Trebuie completat numele clientului',
            'numberInv.required'     => 'trebuie completat numarul facturii',
            'amount.required'        => 'Trebuie completata valoarea facturii',
            'dateInv.required'       => 'Trebuie completata data facturii',
            'status.required'        => 'Trebuie selectat statusul facturii',
            'student_id.required'    => 'Trebuie selectat elevul',
        ];
    }
}
