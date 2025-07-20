<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentsServiceRequest extends FormRequest
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
        'amount' => 'required|numeric|min:0.01',
        'payment_method' => 'required|string|max:255',
        'status' => 'required|string|in:pendiente,completado,fallido', // Puedes personalizar estos estados válidos
        'payment_date' => 'required|date|before_or_equal:now',
        'user_id' => 'required|exists:users,id',
        'event_id' => 'required|exists:events,id'
        ];
    }
}
