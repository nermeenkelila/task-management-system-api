<?php

namespace App\Http\Requests\Task;

use App\Enums\StatusEnum;
use App\Rules\CanStatusCompletedRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
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
            "status" => ['required', 'string', 'in:' . implode(",", StatusEnum::values()), new CanStatusCompletedRule],
        ];
    }

     public function messages(): array
    {
        return [
            'status.in' => "Status must be one of:" . implode(",", StatusEnum::values()),
        ];
    }
}
