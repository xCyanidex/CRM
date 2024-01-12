<?php



namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    
    protected $taskService;
    
    // Constructor to inject TaskService dependency
    public function __construct(TaskService $taskService)
    {   
        $this->taskService=$taskService;
    } 

    /**
     * Retrieve all tasks.
     * Get all tasks from the TaskService.
     * Return a JSON response with the tasks.
     * Return an error response if an exception occurs.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * Delete a task by ID.
     * Delete a task by ID using the TaskService.
     * Return a JSON response with a success message and the deleted task.
     * Return an error response if an exception occurs.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
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
     * Update a task by ID.
     * Update a task by ID using the TaskService.
     * Return a JSON response with a success message and the updated task.
     * Return an error response if an exception occurs
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
     * Create a new task.
     * Create a new task using the TaskService.
     * Return a JSON response with a success message and the created task.
     * Return an error response if an exception occurs.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTask(Request $request){
        try{
            $task = $this->taskService->createTask($request->all());
            return response()->json(['message'=>'Task has been created successfully','task'=>$task],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    } 

    /**
     * Assign a task.
     * Assign a task using the TaskService.
     * Return a JSON response with a success message and the assigned task.
     * Return an error response if an exception occurs.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignTask(Request $request){
        try{
            $task = $this->taskService->assigntask($request->all());
            return response()->json(['message'=>'Task has been assigned successfully','task'=>$task],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }   
    }

    /**
     * Mark a task as completed by ID.
     * Mark a task as completed by ID using the TaskService.
     * Return a JSON response with a success message and the completed task.
     * Return an error response if an exception occurs.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function completeTask($id){
        try{
            $task = $this->taskService->completeTask($id);
            return response()->json(['message'=>'Task completed successfully','task'=>$task],200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()],500);
        }
    }
}
