<?php

/**
 * TaskRepositoryInterface
 * 
 * This interface defines the contract for repository classes that handle database operations
 * related to the Task model. Classes implementing this interface are expected to provide
 * implementations for methods such as creating, retrieving, updating, deleting, assigning and 
 * completion of Tasks.
 *
 * @category Interface
 * @package  App\Interfaces
 */

namespace App\Interfaces;

use Illuminate\Http\Request;
 
// Task interface for CRUD and Assigning Tasks.
interface TaskRepositoryInterface{
    
    
    /**
     * Create a new Task
     *
     * @param  array  $data  Data for creating a new task
     */
    public function createTask(array $data);
    
    
    /**
     * Update a task.
     *
     * @param  array  $data  Data for creating a new task using $id.
     */
    public function updateTask($id,array $data);


    /**
     * Delete a Task.
     *
     * @param  array  $id for deleting a task.
     */
    public function deleteTask($id);


    /**
     * Retrieve all Tasks.
     *
     * No params required.
     */
    public function getAllTasks();


    /**
     * Assign a Task
     *
     * @param  array  $data  Data for assigning a task to employee
     */
    public function assignTask(array $data); 
    
    
    /**
     * Assign a Task
     *
     * @param  array  $id  id for completing a task from employee
     */
    public function completeTask($id);
}