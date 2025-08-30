<?php

namespace App\Http\Requests\Task;

use App\Enums\StatusEnum;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
         return $this->user()->can('viewAny', Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', 'string', 'in:' . implode(",", StatusEnum::values())],
            'assignee_id' => 'nullable|integer|exists:users,id',
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => "Status must be one of:" . implode(",", StatusEnum::values()),
        ];
    }
}
