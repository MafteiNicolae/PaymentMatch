<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
        $nameRule = $this->segment(3) != null ? 'required|unique:teachers,name,' . $this->segment(3) : 'required|unique:teachers,name';
        return [
            'name' => $nameRule,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Trebuie completat campul nume',
            'name.unique'   => 'Exista deja un profesor inregistrat cu acest nume',
        ];
    }
}
