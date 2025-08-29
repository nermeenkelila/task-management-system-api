<?php

namespace App\Services\Task;


use App\Repositories\TaskRepository;


class RetrieveTasksService
{
    protected $repository = null;

    public function __construct(
        TaskRepository $repository

    ) {
        $this->repository = $repository;
    }
    public function execute(array $filters)
     {
       if(empty($filters)){
            return $this->repository->orderBy("id", "desc")->paginate(10);
       }
       return $this->repository->getFilteredTasks($filters);
    }

}