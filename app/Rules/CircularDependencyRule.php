<?php

namespace App\Rules;

use Closure;
use App\Models\Task;
use Illuminate\Contracts\Validation\ValidationRule;

class CircularDependencyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $task = request()->route('task');
        if (!$task) {
            return;
        }

        $dependencies = is_array($value) ? $value : [$value];
        foreach ($dependencies as $dependencyId) {
            if($task->id == $dependencyId){
                $fail("This dependency with id {$dependencyId} has the same task id, Task cannot depend on its self.");
            }
            $dependency = Task::find($dependencyId);
        
            if ($dependency->dependencies->contains('id', $task->id)) {
                $fail("This dependency with id {$dependencyId} would create a circular dependency.");
            }
        }
    }
}
