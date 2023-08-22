<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'prescriber_id' => 'required|int',
            'patient_id' => 'required|int',
            'consultation_id' => 'required|int',
            'record_id' => 'required|int',
            'doses_per_day' => 'required|int',
            'days' => 'required|int',
        ];
    }

    public function prepareForValidation()
    {

    }
}
