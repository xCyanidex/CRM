<?php

/**
 * TaskRepositoryInterface defines the contract for task-related repository operations.
 *
 * This interface outlines the methods that any class implementing it should provide.
 * These methods cover common CRUD operations (create, read, update, delete) for tasks,
 * as well as assigning tasks and retrieving all tasks. Additionally, there's a commented-out
 * method for completing a task, indicating a potential future addition.
 */

namespace App\Interfaces;

use Illuminate\Http\Request;
 
// Task interface for CRUD and Assigning Tasks
interface TaskRepositoryInterface{
    public function createTask(array $data);
    public function updateTask($id,array $data);
    public function deleteTask($id);
    public function getAllTasks();
    public function assignTask(array $data);    
}