<?php

/**
* TaskService provides business logic for task-related operations.
*
* This service class acts as an intermediary between the controller and the
* task repository. It encapsulates the logic for creating, updating, deleting,
* and retrieving tasks. Additionally, it handles the assignment of tasks to
* employees, ensuring authentication and proper data formatting. 
*/

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Repositories\EmployeeRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Mail\Transport\ArrayTransport;


class TaskService {
    // Property to hold the TaskRepository instance and EmployeeRepository instance
    protected $taskRepository;
    protected $employeeRepository;

    // Injects dependencies (repositories) into the service
    public function __construct(TaskRepository $taskRepository,EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository=$employeeRepository;
        $this->taskRepository=$taskRepository;
    }

    // Create a new task based on the provided data.
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

    // Update an existing task identified by its ID with the provided data
    public function updateTask($id,array $data){
        return $this->taskRepository->updateTask($id,[
            'title'=>$data['title'],
            'description'=>$data['description'],
            'start_time'=>$data['start_time'],
            'end_time'=>$data['end_time'],
            'status'=>$data['status'],
        ]);
    }

    // Delete a task identified by its ID
    public function deleteTask($id){
        return $this->taskRepository->deleteTask($id);
    }

    // Retrieve all tasks
    public function getAllTasks(){
        return $this->taskRepository->getAllTasks();
    }

    // Assign a task to an employee based on the provided data
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

