<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AttributeRequest extends FormRequest
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
    protected $stopOnFirstFailure = true;
    public function rules(): array
    {
        $attribute_id = $this->id;
        return [
            'name.*' => ['required', 'string', 'max:60', UniqueTranslationRule::for('attributes', 'name')->ignore($attribute_id)],
            'value.*.*' => ['required', 'string', 'max:60'],
        ];
    }
}
