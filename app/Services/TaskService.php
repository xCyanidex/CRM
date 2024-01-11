<?php

/**
* TaskService provides business logic for task-related operations.
*
* This service class acts as an intermediary between the controller and the
* task repository. It encapsulates the logic for creating, updating, deleting,
* and retrieving tasks. Additionally, it handles the assignment of tasks to
* employees, ensuring authentication and proper data formatting. 
*/

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Repositories\EmployeeRepository;


class TaskService {
    protected $taskRepository;
    protected $employeeRepository;

    /**
 * Constructor for the class
 *
 * @param TaskRepository $taskRepository
 * An instance of the TaskRepository, providing methods to interact with task-related data.
 *
 * @param EmployeeRepository $employeeRepository
 * An instance of the EmployeeRepository, providing methods to interact with employee-related data.
 * Assign the TaskRepository and EmployeeRepository instances to class properties.
 */
    public function __construct(TaskRepository $taskRepository,EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository=$employeeRepository;
        $this->taskRepository=$taskRepository;
    }
    /**
     * Create a new task using data provided.
     * Call the createTask method on the injected TaskRepository 
     * with the provided task data
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
        return $this->taskRepository->createTask(
            [
                'title'=>$data['title'],
                'description'=>$data['description'],
                'start_time'=>$data['start_time'],
                'end_time'=>$data['end_time'],
                'status'=>$data['status'],
            ]
        );

    }

    /**
    * Update an existing task with the provided data.
    * Call the updateTask method on the injected TaskRepository
    * with the provided task identifier and data.
    *
    * @param mixed $id
    *      The identifier of the task to be updated.
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
        return $this->taskRepository->updateTask($id,$data);
    }

    /**
    * Delete an existing task based on its identifier.
    * Call the deleteTask method on the injected TaskRepository
    * with the provided task identifier.
    *
    * @param mixed $id
    *      The identifier of the task to be deleted.
    *
    * @return mixed
    *      Returns the result of the deleteTask method from the TaskRepository.
    */
    public function deleteTask($id){
        return $this->taskRepository->deleteTask($id);
    }

    /**
    * Retrieve all tasks from the repository.
    * Call the getAllTasks method on the injected TaskRepository
    * to retrieve all tasks.
    *
    * @return mixed
    *      Returns the result of the getAllTasks method from the TaskRepository.
    */
    public function getAllTasks(){
        return $this->taskRepository->getAllTasks();
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
    public function assigntask(array $data){
        
        return $this->taskRepository->assignTask([
            'assigned_to'=>$data['assigned_to'],
            'assigned_by'=>$data['assigned_by'],
            'task_id'=>$data['task_id']
        ]);

    }
   
}

