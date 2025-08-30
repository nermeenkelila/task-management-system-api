<?php

namespace App\Services\Task;


use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class RetrieveTasksService
{
    protected $repository = null;

    public function __construct(
        TaskRepository $repository

    ) {
        $this->repository = $repository;
    }
    public function execute(array $filters): Collection
     {
       if(empty($filters)){
            return $this->repository->orderBy("id", "desc")->get();
       }
       return $this->repository->getFilteredTasks($filters);
    }

}