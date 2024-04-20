<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends FormRequest
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
                'max:20',
                Rule::unique(Department::class)->ignore($this->departmentId, 'code'),
            ],
            'name'=>[
                'required',
                'string',
                'max:80',
            ],
            'parent_id',
            'company_id'=>[
                'required',
                Rule::exists(Company::class, 'id')
            ],
        ];
    }
}
