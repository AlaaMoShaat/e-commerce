<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        $rules = [
            'code' => ['required', 'string', 'size:10', 'unique:coupons,code,'. $this->route('coupon')],
            'discount_percentage' => ['required', 'numeric', 'between:1,100'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'limit' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'in:0,1'],
        ];

        if($this->method() == 'PUT') {
            $rules['status'] = ['nullable'];
        }else {
            $rules['status'] =['required', 'in:0,1'];
        }
        return $rules;
    }
}