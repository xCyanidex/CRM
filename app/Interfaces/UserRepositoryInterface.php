<?php

namespace App\Interfaces;

/**
 * Interface UserRepositoryInterface
 * 
 * This interface defines methods for interacting with user data.
 */
interface UserRepositoryInterface
{
    /**
     * Create a new user.
     *
     * @param array $data The user data.
     */
    public function createUser(array $data);

    /**
     * Get all users.
     *
     * @return array
     */
    public function getAllUsers();

    /**
     * Find a user by their ID.
     *
     * @param int $id The user ID.
     * @param mixed get a single user by its id
     */
    public function findUserById($id);

    /**
     * Update a user.
     *
     * @param int $id The user ID.
     * @param array $data The updated user data.
     * @return mixed The updated user
     */
    public function updateUser($id, array $data);

    /**
     * Delete a user by their ID.
     *
     * @param int $id The user ID.
     * @return mixed delete the user
     */
    public function deleteUser($id);

    /**
     * Find a user by their email address.
     *
     * @param string $email The user email address.
     * @return mixed fetches the user based on its unique email
     */
    public function findByEmail($email);
}
