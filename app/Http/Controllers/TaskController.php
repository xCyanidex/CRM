<?php

/**
 * TaskController handles HTTP requests related to tasks in the application.
 *
 * This controller interacts with the TaskService to perform actions such as
 * retrieving, creating, updating, assigning, and deleting tasks. It also
 * includes validation logic for incoming requests. The controller is responsible
 * for handling the communication between the client and the application's
 * task-related functionalities.
 */

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use App\Services\TaskService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    //Property to hold the TaskService instance
    protected $taskService;
    
    //injecting TaskService dependency
    public function __construct(TaskService $taskService)
    {   
        $this->taskService=$taskService;
    } 

    // Retrieving all tasks
    public function ShowTask(){
        $task = $this->taskService->getAllTasks();
        if(!$task){
            return response()->json(['message'=>'Task not found']);
        }else{
            return response()->json(['tasks'=>$task]);
        }
    }

    // Deleting Task by ID
    public function deleteTask(Request $request,$id){
        $task = $this->taskService->findById($id);
        if(!$task){
            return response()->json(['message'=>'task not found']);
        }else{
            return $this->taskService->deleteTask($id);
        }        
    }

    // Update Task by ID
    public function updateTask(Request $request,$id){
        $task=$this->taskService->findById($id);
        if(!$task){
            return response()->json(['message'=>'task not found']);
        }else{
            $data=$request->all();
            return $this->taskService->updateTask($id,$data);
        }
    }  

    // Create new task using TaskService
    public function createTask(Request $request){
        return $this->taskService->createTask($request->all());
    } 

    // Assign Task
    public function assignTask(Request $request){
        return $this->taskService->assigntask($request->all());
    }



}
