<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterCarRequest extends FormRequest
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
            'search' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:50'],
            'year' => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y')],
            'sortBy' => ['nullable', 'string', Rule::in(['name', 'year', 'color', 'price', 'created_at'])],
            'order' => ['nullable', 'string', Rule::in(['asc', 'desc', 'ASC', 'DESC'])],
            'perPage' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'perPage.integer' => 'A quantidade de itens deve ser um inteiro',
            'color.string' => 'A cor deve ser uma string válida',
            'color.max' => 'A cor deve conter até :max',
            'year.integer' => 'O ano deve ser um número válido',
            'order.in' => 'A ordenação deve ser somente "asc" ou "desc"'
        ];
    }
}
