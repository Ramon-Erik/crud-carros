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
            'name' => 'required|min:3|max:15',
            'model' => 'required|string|max:30',
            'manufacture_year' => 'required|integer',
            'color' => 'required|string|max:9'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos :min caracteres.',
            'name.max' => 'O nome não pode ter mais de :max caracteres.',

            'model.required' => 'O campo modelo é obrigatório.',
            'model.string' => 'O modelo deve ser um texto.',
            'model.max' => 'O modelo não pode ter mais de :max caracteres.',

            'manufacture_year.required' => 'O ano de fabricação é obrigatório.',
            'manufacture_year.integer' => 'O ano de fabricação deve ser um número inteiro.',

            'color.required' => 'O campo cor é obrigatório.',
            'color.string' => 'A cor deve ser um texto.',
            'color.max' => 'A cor não pode ter mais de :max caracteres.',
        ];
    }
}
