<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class BrandRequest extends FormRequest
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
        $brandId = $this->route('brand');
        $rules =  [
            'name.*' => ['required', 'min:2', 'max:60', UniqueTranslationRule::for('brands')->ignore($brandId)],
           'status' => ['required', 'in:0,1'],

        ];
        if($this->method() == 'PUT') {
            $rules['logo'] = ['nullable', 'max:2048'];
        }else {
            $rules['logo'] =['required', 'max:2048'];
        }
        return $rules;
    }
}