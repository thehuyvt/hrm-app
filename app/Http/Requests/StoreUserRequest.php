<?php

namespace App\Http\Requests;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'email'=>[
                'required',
                Rule::unique(User::class)->ignore($this->user),
            ],
            'password'=>[
                'required',
                'string',
                'max:200',
            ],
//            'is_active'=>[
//                'required',
//                'boolean',
//            ],
            'full_name'=>[
                'required',
                'string',
                'max:50',
            ],
            'gender'=>[
                'required',
                'boolean'
            ],
            'birthdate'=>[
                'required',
                'date',
                'before:' . now()->subYears(6)->format('Y-m-d'),
            ],
            'phone_number'=>[
                'required',
                'string',
                'max:20',
                Rule::unique(Person::class),
            ],
            'address'=>[
                'max:200'
            ],
        ];
    }
}
