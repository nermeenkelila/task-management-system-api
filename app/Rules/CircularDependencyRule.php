<?php

namespace App\Rules;

use Closure;
use App\Models\Task;
use Illuminate\Contracts\Validation\ValidationRule;

class CircularDependencyRule implements ValidationRule
{
    public function __construct(protected ?Task $task = null) {}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->task) {
            return;
        }

        $dependencies = is_array($value) ? $value : [$value];
        foreach ($dependencies as $dependencyId) {
            $dependency = Task::find($dependencyId);
        
            if ($dependency->dependencies->contains('id', $this->task->id)) {
                $fail("This dependency with id {$dependencyId} would create a circular dependency.");
            }
        }
    }
}
