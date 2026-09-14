<?php

namespace App\Http\Requests\car;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min_digits:3',
            'model' => 'required',
            'manufacture_year' => 'required|int',
            'color' => 'required|string|max_digits:9'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.min_digits' => 'O nome deve ter pelo menos 3 caracteres',
            'model.required' => 'O modelo é obrigatório',
            'manufacture_year.int' => 'O ano deve ser um valor inteiro',
            'manufacture_year.required' => 'O ano é obrigatório',
            'color.required' => 'O modelo é obrigatório',
            'color.max_digits' => 'Cor de até 9 digitos (hexadecimal com # ou nome)',
            'color.string' => 'A cor deve ser uma string'
        ];
    }
}
