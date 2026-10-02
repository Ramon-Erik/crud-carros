<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CarCadastroRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20|min:3',
            'model' => 'required|string|max:20|min:3',
            'year' => 'required|integer|max:' . date('Y') . '|min:1900',
            'color' => 'required|string|max:15|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome não pode ter mais que 20 caracteres.',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',

            'model.required' => 'O campo modelo é obrigatório.',
            'model.string' => 'O modelo deve ser um texto válido.',
            'model.max' => 'O modelo não pode ter mais que 20 caracteres.',
            'model.min' => 'O modelo deve ter pelo menos 3 caracteres.',

            'year.required' => 'O campo ano é obrigatório.',
            'year.integer' => 'O ano deve ser um número inteiro.',
            'year.max' => 'O ano não pode ser maior que o ano atual (' . date('Y') . ').',
            'year.min' => 'O ano não pode ser menor que 1900.',

            'color.required' => 'O campo cor é obrigatório.',
            'color.string' => 'A cor deve ser um texto válido.',
            'color.max' => 'A cor não pode ter mais que 15 caracteres.',
            'color.min' => 'A cor deve ter pelo menos 3 caracteres.',
        ];
    }
}
