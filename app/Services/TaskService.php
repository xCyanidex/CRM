<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Models\Task;

class TaskService {
    protected $taskRepository;
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository=$taskRepository;
    }
    public function createTask(array $data){
        return $this->taskRepository->createTask([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'start_time'=>$data['start_time'],
            'end_time'=>$data['end_time'],
            'status'=>'unassigned',
        ]);
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
    public function getAllTasks($id){
        return $this->taskRepository->getAllTasks($id);
    }
    public function assignTask(array $data){
        
    }
}

