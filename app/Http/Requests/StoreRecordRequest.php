<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecordRequest extends FormRequest
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
            'allergies' => 'array',
            'pathologies' => 'array',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }

    public function prepareForValidation()
    {

    }
}
