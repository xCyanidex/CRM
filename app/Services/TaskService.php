<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Repositories\EmployeeRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Mail\Transport\ArrayTransport;

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
    public function assigntask(array $data){
        $employee = Auth::user();
        if(!$employee){
            return response()->json(['message'=>'employee does not exist']);
        }
        $assigned_by = $employee->id;
        
        return $this->taskRepository->assignTask([
            'assigned_to'=>$data['assigned_to'],
            'assigned_by'=>$assigned_by,
            'task_id'=>$data['task_id']
        ]);

    }
   
}

