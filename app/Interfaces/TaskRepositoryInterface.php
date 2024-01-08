<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface TaskRepositoryInterface{
    public function createTask(array $data);
    public function updateTask($id,array $data);
    public function deleteTask($id);
    public function getAllTasks();
    public function assignTask(array $data);
    // public function completeTask($id);
    
}