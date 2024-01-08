<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use App\Services\TaskService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    protected $taskService;
    public function __construct(TaskService $taskService)
    {   
        $this->taskService=$taskService;
    } 
    public function ShowTask(){
        $task = $this->taskService->getAllTasks();
        if(!$task){
            return response()->json(['message'=>'Task not found']);
        }else{
            return response()->json(['tasks'=>$task]);
        }
    }
    public function deleteTask(Request $request,$id){
        $task = $this->taskService->findById($id);
        if(!$task){
            return response()->json(['message'=>'task not found']);
        }else{
            return $this->taskService->deleteTask($id);
        }        
    }
    public function updateTask(Request $request,$id){
        $task=$this->taskService->findById($id);
        if(!$task){
            return response()->json(['message'=>'task not found']);
        }else{
            $data=$request->all();
            return $this->taskService->updateTask($id,$data);
        }
    }  
    public function createTask(Request $request){
        return $this->taskService->createTask($request->all());
    } 
    public function assignTask(Request $request){
        return $this->taskService->assigntask($request->all());
    }

//
//     protected $employeeService;
//     protected $taskService;
//     public function __construct(EmployeeService $employeeService,TaskService $taskService)
//     {   
//         $this->employeeService=$employeeService;
//         $this->taskService->$taskService;
//     }

//     public function assignTask(Request $request,$task_id){
//         $validator = Validator::make($request->all(),[
//             'assigned_to'=>'required | exists:employees,id',
//         ]);

//         $assigned_to=$request->input('assigned_to');
//         $assigned_task = $this->taskService->assignTask($task_id,$assigned_to);
//         return response()->json(['message'=>'Task assigned succcessfully','task'=>$assigned_task]);
//     }



}
