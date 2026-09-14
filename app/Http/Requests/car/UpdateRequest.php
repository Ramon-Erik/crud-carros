<?php

namespace App\Http\Requests\car;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|min:3|max:15',
            'model' => 'sometimes|string|max:30',
            'manufacture_year' => 'sometimes|integer',
            'color' => 'sometimes|string|max:9'
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'O nome deve ter pelo menos :min caracteres.',
            'name.max' => 'O nome não pode ter mais de :max caracteres.',

            'model.string' => 'O modelo deve ser um texto.',
            'model.max' => 'O modelo não pode ter mais de :max caracteres.',

            'manufacture_year.integer' => 'O ano de fabricação deve ser um número inteiro.',

            'color.string' => 'A cor deve ser um texto.',
            'color.max' => 'A cor não pode ter mais de :max caracteres.',
        ];
    }
}
