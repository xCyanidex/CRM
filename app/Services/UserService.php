<?php

/**
 * UserService Class
 *
 * Responsible for managing user-related operations.
 * Acts as an intermediary between controllers and the UserRepository.
 */

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    protected $userRepository;

    /**
     * Constructor for UserService.
     *
     * @param UserRepository $userRepository The repository for user-related database operations
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users.
     *
     * @return mixed Returns all users
     */
    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    /**
     * Get a user by their ID.
     *
     * @param int $id The ID of the user to retrieve
     * @return mixed Returns the user with the given ID
     */
    public function getUser($id)
    {
        return $this->userRepository->findUserById($id);
    }

    /**
     * Update a user.
     *
     * @param array $data Data for updating the user
     * @param int $id The ID of the user to update
     * @return mixed Returns the updated user or appropriate error response
     */
    public function updateUser(array $data, $id)
    {
        return $this->userRepository->updateUser($id, $data);
    }

    /**
     * Delete a user.
     *
     * @param int $id The ID of the user to delete
     * @return mixed Returns the deletion status or appropriate error response
     */
    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
