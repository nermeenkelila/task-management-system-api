<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use App\Enums\StatusEnum;
use Illuminate\Validation\Rule;
use App\Rules\CanStatusCompletedRule;
use App\Rules\CircularDependencyRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
    //    $task = Task::find($this->route('task'));
       return $this->user()->can('update', $this->task);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["sometimes","required","string","min:2","max:100", Rule::unique('tasks')->ignore(request()->route('task'))],
            "description" => "nullable|string|min:5",
            "assignee_id" => "sometimes|required|exists:users,id",
            "due_date" => "sometimes|required|date_format:Y-m-d|after_or_equal:today",
            "status" => ['nullable', 'string', 'in:' . implode(",", StatusEnum::values()), new CanStatusCompletedRule],
            "dependencies" => 'nullable|array',
            "dependencies.*" => ['exists:tasks,id', new CircularDependencyRule]
        ];
    }
}
