<?php

/**
 * TaskRepository implements the TaskRepositoryInterface for task-related database operations.
 *
 * This repository class provides methods to interact with the database for tasks,
 * implementing the methods declared in the TaskRepositoryInterface. It utilizes
 * Eloquent models (Task and Employee) for database interactions.
 */

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Employee;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface{
    
    // Property to hold the Task model instance and Employee model instance
    protected $task;
    protected $employee;

    // Injecting dependencies (Eloquent models) into the repository
    public function __construct(Task $task,Employee $employee)
    {   
        $this->employee=$employee;
        $this->task = $task;
    }

    // Create a new task based on the provided data
    public function createTask(array $data){
        return $this->task->create($data);
    }

    // Update an existing task identified by its ID with the provided data
    public function updateTask($id,array $data){
        return $this->task->update($id,$data);
    }

    // Delete a task identified by its ID
    public function deleteTask($id){
        return $this->task->delete($id);
    }

    // Retrieve all tasks with relationships to assigned_to and assigned_by
    public function getAllTasks(){  
        return $this->task->with(['assigned_to','assigned_by']);
    }

    // Assign a task to an employee based on the provided data
    public function assignTask(array $data){
        return $this->task->create($data);
    }
   
}