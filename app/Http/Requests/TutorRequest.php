<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorRequest extends FormRequest
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
            'student_id'    => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Trebuie completat numele parintelui',
            'student_id.required'   => 'Trebuie selecta numele elevului',
        ];
    }
}
