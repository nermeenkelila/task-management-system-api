<?php

namespace App\Rules;

use App\Enums\StatusEnum;
use Closure;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Validation\ValidationRule;

class CanStatusCompletedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value != StatusEnum::COMPLETED->value){
            return;
        }
        $repository = app(TaskRepository::class);
        $task = request()->route('task');
        if($repository->getCountOfNonCompletedDependences($task->id) > 0)
        {
            $fail("This {$attribute} can not be updated where its dependencies not completed");
        }
    }
}
