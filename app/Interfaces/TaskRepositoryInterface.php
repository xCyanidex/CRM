<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface TaskRepositoryInterface{
    public function createTask(array $data);
    public function updateTask($id,array $data);
    public function deleteTask($id);
    public function getAllTasks($id);
    public function assignTask($id,$assigned_by,$assigned_to);
    public function completeTask($id);
    
}