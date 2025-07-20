<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessagesServiceRequest extends FormRequest
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
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date|after_or_equal:now',
        'end_date' => 'required|date|after:start_date',
        'location' => 'required|string|max:255',
        'status' => 'required|string|in:pendiente,en_progreso,finalizado', // Puedes personalizar los estados válidos
        'organizer_id' => 'required|exists:users,id',
        ];
    }
}
