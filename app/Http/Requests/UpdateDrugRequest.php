<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDrugRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() && in_array(auth()->user()->role, ['administrator', 'pharmacist']);
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
            'generic_name' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'expiry_date' => 'nullable|date',
            'batch_number' => 'nullable|string|max:255',
            'requires_prescription' => 'boolean',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Drug name is required.',
            'category.required' => 'Drug category is required.',
            'price.required' => 'Drug price is required.',
            'price.min' => 'Price must be greater than or equal to 0.',
            'stock_quantity.required' => 'Stock quantity is required.',
            'stock_quantity.min' => 'Stock quantity must be greater than or equal to 0.',
            'minimum_stock.required' => 'Minimum stock level is required.',
            'minimum_stock.min' => 'Minimum stock must be at least 1.',
            'unit.required' => 'Unit is required.',
        ];
    }
}