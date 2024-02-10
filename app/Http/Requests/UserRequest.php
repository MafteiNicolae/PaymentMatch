<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $emailRule = $this->segment(3) != null ? 'required|email|unique:users,email,' . $this->segment(3) : 'required|email|unique:users,email';
        $passwordRule = $this->segment(3) == null ? 'required|min:6' : '';
        return [
            'name'      => 'required|min:3',
            'email'     => $emailRule,
            'password'  => $passwordRule,
            'role'      => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Campul nume trebuie sa fie completat',
            'name.min'          => 'Numele trebuie sa aiba minim 3 caractere',
            'email.required'    => 'Campul e-mail trebuie sa fie completat',
            'email.unique'      => 'Exista deja un cont inregistrat cu aceasta adresa de mail',
            'password.required' => 'Campul parola trebuie sa fie completat',
            'password.min'      => 'Parola trebuie sa aiba minim 6 caractere',
            'role.required'     => 'Trebuie selectat un rol',
        ];
    }
}
