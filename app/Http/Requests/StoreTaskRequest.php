<?php

namespace App\Http\Requests;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Models\Person;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'name'=>[
                'required',
                'string',
                'max:255',
            ],
            'description'=>[
                'max:1000'
            ],
            'start_time'=>[
                'sometimes',
                'required',
                'date',
                'after:'.now()->format('Y-m-d'),
            ],
            'end_time'=>[
                'sometimes',
                'required',
                'date',
                'after_or_equal:start_time',
            ],
            'project_id'=>[
                'required',
                Rule::exists(Project::class, 'code'),
            ],
            'person_id'=>[
                'required',
                Rule::exists(Person::class, 'id'),
            ],
            'priority'=>[
                'required',
                Rule::in(TaskPriorityEnum::getArrayPriority()),
            ],
            'status'=>[
                'required',
                Rule::in(TaskStatusEnum::getArrayStatus()),
            ]
        ];
    }
}
