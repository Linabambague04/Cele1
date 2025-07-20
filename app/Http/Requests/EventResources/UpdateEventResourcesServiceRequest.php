<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdarteEventResourcesServiceRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'event_id' => 'required|exists:events,id',
        ];
    }
}
