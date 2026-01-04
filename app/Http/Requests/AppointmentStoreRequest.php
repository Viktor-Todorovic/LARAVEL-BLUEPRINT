<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
        'client_name' => ['required', 'string', 'max:255'],
        'client_phone' => ['required', 'string', 'max:50'],
        'service_id' => ['required', 'exists:services,id'],
        'appointment_date' => ['required', 'date'],
    ];
    }
}
