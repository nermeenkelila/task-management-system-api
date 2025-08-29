<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $task) {
        parent::__construct($task);
    }
}