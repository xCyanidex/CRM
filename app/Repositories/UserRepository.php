<?php

/**
 * Class UserRepository
 * 
 * This class manages database operations related to users within the application.
 * It serves as an intermediary between the application's business logic and the
 * User model, encapsulating various database operations.
 * 
 * Responsibilities:
 * - Creating, retrieving, updating, and deleting users in the database.
 * - Provides methods to fetch users and perform CRUD operations.
 * 
 * Usage:
 * The methods within this class can be used across the application to handle
 * user-related database interactions.
 */

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    /**
     * The User model instance.
     *
     * @var User
     */
    protected $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create a new user.
     *
     * @param array $data The data for creating the user.
     * @return mixed The created user instance.
     */
    public function createUser(array $data)
    {
        return $this->user->create($data);
    }

    /**
     * Find a user by email.
     *
     * @param string $email The email to search for.
     * @return mixed The user instance if found, otherwise null.
     */
    public function findByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    /**
     * Get all users.
     *
     * @return mixed All user instances.
     */
    public function getAllUsers()
    {
        return $this->user->all();
    }

    /**
     * Find a user by ID.
     *
     * @param int $id The user ID.
     * @return mixed The user instance.
     * @throws ModelNotFoundException If the user is not found.
     */
    public function findUserById($id)
    {
        return $this->user->findOrFail($id);
    }

    /**
     * Update a user by ID.
     *
     * @param int $id The user ID.
     * @param array $data The data for updating the user.
     * @return mixed The updated user instance.
     */
    public function updateUser($id, array $data)
    {
        return $this->user->findOrFail($id)->update($data);
    }

    /**
     * Delete a user by ID.
     *
     * @param int $id The user ID.
     * @return bool True if successful deletion, otherwise false.
     */
    public function deleteUser($id)
    {
        return $this->user->findOrFail($id)->delete();
    }
}
