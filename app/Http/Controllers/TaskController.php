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

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    //Property to hold the TaskService instance
    protected $taskService;
    
    /**
     * Constructor for the MyClass class.
     *
     * @param TaskService $taskService The TaskService instance to be injected.
     *
     * @return void
    */
    public function __construct(TaskService $taskService)
    {   
        $this->taskService=$taskService;
    } 

    /**
     * Show all tasks.
     *
     * This method retrieves all tasks using the TaskService and returns a JSON response.
     * If an exception occurs during the process, it handles the exception by returning
     * a JSON response with an error message and a 500 status code.
     * No parameters are needed for this function.
     * @return Returns a JSON response containing all tasks on success.
     * On failure, returns a JSON response with an error message and 500 status code.
     */
    public function ShowTask(){
        try{
            $task = $this->taskService->getAllTasks();
            return response()->json(['tasks'=>$task],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }

    /**
     * Delete specific task.
     * This method deletes the task using the TaskService and returns a JSON response.
     * @param Request $request and ID for the task to be deleted.
     * @return JSON response for deleting the task.
     * @return JSON response if an exception occurs during the process, it handles the exception
     * by returning a 500 status code.
     */
    public function deleteTask(Request $request,$id){
        try{
            $task = $this->taskService->deleteTask($id);
            return response()->json(['message'=>'Task has been deleted successfully','task'=>$task]);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()]);
        }
    }

    /**
     * Update specific task.
     * This method updates the task using the TaskService and returns a JSON response.
     * @param Request $request and ID for the task to be updated.
     * @return JSON response for updating the task.
     * @return JSON response if an exception occurs during the process, it handles the exception
     * by returning a 500 status code.
     */
    public function updateTask($id,Request $request){
        try{
            $task=$this->taskService->updateTask($id,$request->all());
            return response()->json(['message'=>'task updated successfully','task'=>$task],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500); 
        }
    }  

    /**
     * Create specific task.
     * This method creates the task using the TaskService and returns a JSON response.
     * @param Request $request.
     * @return creates a task using the TaskService.
     */
    public function createTask(Request $request){
        return $this->taskService->createTask($request->all());
    } 

    /**
     * Assigns specif task to specific employee.
     * This method assigns the task to an employee using the TaskService and returns a JSON repsonse.
     * @param Request $request.
     * @return assigns a task using the TaskService.
     */
    public function assignTask(Request $request){
        return $this->taskService->assigntask($request->all());
    }



}
