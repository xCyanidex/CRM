<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Employee;
use App\Models\Task;

use function Laravel\Prompts\error;

// use Illuminate\Http\Request;

class TaskRepository implements TaskRepositoryInterface{
    protected $task;
    protected $employee;
    public function __construct(Task $task,Employee $employee)
    {   
        $this->employee=$employee;
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
    public function getAllTasks(){  
        return $this->task->with(['assigned_to','assigned_by']);
    }
   
}