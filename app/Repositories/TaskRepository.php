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
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface{
    
    // Property to hold the Task model instance and Employee model instance
    protected $task;
    protected $employee;

    /**
     * Constructor for the class.
     * Assign the TaskRepository and EmployeeRepository instances to class properties.
     *
     * @param TaskRepository $taskRepository
     * An instance of the TaskRepository, providing methods
     * to interact with task-related data.
     *
     * @param EmployeeRepository $employeeRepository
     * An instance of the EmployeeRepository, providing methods
     * to interact with employee-related data.
     */
    public function __construct(Task $task,Employee $employee)
    {   
        $this->employee=$employee;
        $this->task = $task;
    }

    /**
     * Create a new task using data provided.
     * Call the createTask method on the injected TaskRepository with the provided task data.
     *
     * @param array $data
     *      An associative array containing task data, including:
     *      - 'title': The title of the task.
     *      - 'description': The description of the task.
     *      - 'start_time': The start time of the task.
     *      - 'end_time': The end time of the task.
     *      - 'status': The status of the task.
     *
     * @return mixed
     *      Returns the result of the createTask method from the TaskRepository.
     */
    public function createTask(array $data){
        return $this->task->create($data);
    }

    /**
     * Update an existing task with the provided data.
     * Call the updateTask method on the injected TaskRepository
     * with the provided task identifier and data.
     *
     * @param mixed $id
     * The identifier of the task to be updated.
     *
     * @param array $data
     *      An associative array containing task data to update, including:
     *      - 'title': The updated title of the task.
     *      - 'description': The updated description of the task.
     *      - 'start_time': The updated start time of the task.
     *      - 'end_time': The updated end time of the task.
     *      - 'status': The updated status of the task.
     *
     * @return mixed
     *      Returns the result of the updateTask method from the TaskRepository.
     */
    public function updateTask($id,array $data){
        return $this->task->findOrFail($id)->update($data);
    }

    /**
     * Delete an existing task based on its identifier.
     * Call the deleteTask method on the injected TaskRepository 
     * with the provided task identifier.
     *
     * @param mixed $id
     * The identifier of the task to be deleted.
     *
     * @return mixed
     * Returns the result of the deleteTask method from the TaskRepository.
     */
    public function deleteTask($id){
        return $this->task->findOrFail($id)->delete();
    }

    /**
     * Retrieve all tasks from the repository.
     * Call the getAllTasks method on the injected TaskRepository to retrieve all tasks.
     *
     * @return mixed
     *      Returns the result of the getAllTasks method from the TaskRepository.
     */
    public function getAllTasks(){  
        return $this->task->all();
    }

     /**
     * Assign a task to an employee based on the provided data.
     * Call the assignTask method on the injected TaskRepository 
     * with the provided assignment data.
     *
     * @param array $data
     *      An associative array containing assignment data, including:
     *      - 'assigned_to': The identifier of the employee to whom the task is assigned.
     *      - 'assigned_by': The identifier of the employee who assigned the task.
     *      - 'task_id': The identifier of the task being assigned.
     *
     * @return mixed
     *      Returns the result of the assignTask method from the TaskRepository.
     */
    public function assignTask(array $data){
        $assigned_to = $this->employee->findOrFail($data['assigned_to']);
        $assigned_by = Auth::user();
        $task_id = $this->task->find($data['task_id']);
        return $this->task->employee()->attach($assigned_to,['assigned_by'=>$assigned_by->id],$task_id);
        
    }
   
}