<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'exists:products,id',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'The client is required.',
            'client_id.exists' => 'The selected client is invalid.',
            'product_ids.required' => 'At least one product must be selected.',
            'product_ids.*.exists' => 'One or more selected products are invalid.',
        ];
    }
}
