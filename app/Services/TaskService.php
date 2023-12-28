<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Models\Task;
use App\Repositories\EmployeeRepository;
use GuzzleHttp\Psr7\Request;

class TaskService {
    protected $taskRepository;
    protected $employeeRepository;
    public function __construct(TaskRepository $taskRepository,EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository=$employeeRepository;
        $this->taskRepository=$taskRepository;
    }
    public function createTask(array $data){
        return $this->taskRepository->createTask(
            [
                'title'=>$data['title'],
                'description'=>$data['description'],
                'start_time'=>$data['start_time'],
                'end_time'=>$data['end_time'],
                'status'=>$data['status'],
            ]
        );

    }
    public function updateTask($id,array $data){
        return $this->taskRepository->updateTask($id,[
            'title'=>$data['title'],
            'description'=>$data['description'],
            'start_time'=>$data['start_time'],
            'end_time'=>$data['end_time'],
            'status'=>$data['status'],
        ]);
    }
    public function deleteTask($id){
        return $this->taskRepository->deleteTask($id);
    }
    public function getAllTasks(){
        return $this->taskRepository->getAllTasks();
    }
   
}

