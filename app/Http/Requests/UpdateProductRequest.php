<?php

namespace App\Http\Requests;

class UpdateProductRequest extends ApiFormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:category,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name requerido',
            'name.string' => 'Name debe ser string',
            'name.max' => 'Name debe tener un max de 255 caracteres'
        ];
    }
}
