<?php

/**
 * TaskRepository implements the TaskRepositoryInterface for task-related database operations.
 *
 * This repository class provides methods to interact with the database for tasks,
 * implementing the methods declared in the TaskRepositoryInterface. It utilizes
 * Eloquent models (Task and Employee) for database interactions.
 */

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface{
    
    // Property to hold the Task model instance and Employee model instance
    protected $task;
    protected $employee;
    protected $employeeTask;

    
    /**
     * Constructor to initialize TaskRepository with Task, Employee, and EmployeeTask instances.
     *
     * @param Task $task
     * @param Employee $employee
     * @param EmployeeTask $employeeTask
     */
    public function __construct(Task $task,Employee $employee, EmployeeTask $employeeTask)
    {   
        $this->employee=$employee;
        $this->task = $task;
        $this->employeeTask= $employeeTask;
    }


    /**
     * Create a new task with the provided data.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */    
    public function createTask(array $data){
        return $this->task->create($data);
    }

    
    /**
     * Update an existing task with the provided data.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateTask($id,array $data){
        return $this->task->findOrFail($id)->update($data);
    }
    

    /**
     * Delete a task with the specified ID.
     *
     * @param int $id
     * @return bool|null
     */
    public function deleteTask($id){
        return $this->task->findOrFail($id)->delete();
    }


    /**
    * Get all tasks from the database.
    *
    * @return \Illuminate\Database\Eloquent\Collection
    */
    public function getAllTasks(){  
        return $this->task->all();
    }


    /**
    * Assign a task to an employee.
    *
    * @param array $data
    * @return array
    */
    public function assignTask(array $data){
        $assigned_to = $data['assigned_to'];    
        $assigned_by = Auth::user();
        $assigned_by_employee = $assigned_by->employee;
        $task_id = $data['task_id'];
        $status = $this->task->findOrFail($task_id);
        $status->status = 'pending';
        $status->save();
            
        $result =  $this->employeeTask->create(['assigned_to'=>$assigned_to,'assigned_by'=>$assigned_by_employee->id,'task_id'=>$task_id]);
        return ['Task' => $status,'employee_tasks'=>$result];
    }


    /**
     * Mark a task as completed.
     *
     * @param int $id
     * @return bool
     */
    public function completeTask($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'completed';
        return $task->save();
    }
   
}