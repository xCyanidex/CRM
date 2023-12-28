<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
// use Illuminate\Http\Request;

class TaskRepository implements TaskRepositoryInterface{
    protected $task;
    public function __construct(Task $task)
    {   
        $this->task = $task;
    }
    public function createTask(array $data){
        return $this->task->create($data);
    }
    public function updateTask($id,array $data){
        return $this->task->update($id,$data);
    }
    public function deleteTask($id){
        return $this->task->delete($id);
    }
    public function getAllTasks($id){  
        return $this->task->with(['assigned_to','assigned_by'])->findOrFail('id');
    }
    public function assignTask($id, $assigned_by, $assigned_to)
    {
        
    }
}