<?php

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
            'code'=>[
                'required',
                'string',
                Rule::unique(Country::class)->ignore($this->countryId),
            ],
            'name'=>[
                'required',
                'string',
                'max:50'
            ],
            'description'=>[
                'max: 500',
            ],
        ];
    }
}
