<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'array',
                UniqueTranslationRule::for('countries', 'name')->ignore($this->route('country')),
            ],
            'phone_code' => 'required|string|max:10',
            'iso_code' => [
                'required',
                'string',
                'size:2',
                'unique:countries,iso_code,' . $this->route('country'),
            ],
            'status' => 'required|in:0,1',
        ];
    }
}