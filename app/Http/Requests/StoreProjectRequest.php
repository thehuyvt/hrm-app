<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:150',
            ],
            'description'=>[
                'required',
                'string'
            ],
            'company_id'=>[
                'required',
                Rule::exists(Company::class, 'id'),
            ],
            'people'=>[
                'required',
                Rule::exists(Person::class, 'id'),
            ],
        ];
    }
}
