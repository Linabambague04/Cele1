<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupportServiceRequest extends FormRequest
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
            'message' => 'required|string',
            'status' => 'required|string|in:pendiente,en_proceso,respondido,cerrado', // personaliza los estados válidos
            'date' => 'required|date|before_or_equal:now',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
