<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        $nameRule = $this->segment(3) != null ? 'required|unique:groups,name,'. $this->segment(3) : 'required|unique:groups';
        return [
            'name'      => $nameRule,
            'shedule'   => 'required',
            'teacher_id'=> 'required',
        ];
    }

    public function messages(){
        return [
            'name.required'         => 'Trebuie completat campul nume',
            'name.unique'           => 'O grup cu acest nume este inregistratat deja',
            'shedule.required'      => 'Trebuie completat campul orar',
            'teacher_id.required'   => 'Trebuie selectat un profesor',
        ];
    }
}
