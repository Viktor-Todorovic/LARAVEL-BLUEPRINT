<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:50'],
            'stock_quantity' => ['required', 'integer'],
            'price_per_meter' => ['required', 'numeric', 'between:-999999.99,999999.99'],
        ];
    }
}
