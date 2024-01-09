<?php

/**
 * FreelancerService
 * 
 * This service class encapsulates business logic related to freelancer operations.
 * It acts as an intermediary between the FreelancerController and the underlying data layer,
 * utilizing the FreelancerRepository and UserRepository for database interactions.
 *
 * @category Service
 * @package  App\Services
 */

namespace App\Services;

use App\Repositories\FreelancerRepository;
use App\Repositories\UserRepository;
use App\Models\Freelancer;

class FreelancerService
{
    // Instance of the FreelancerRepository for database interactions
    protected $freelancerRepository;

    // Instance of the UserRepository for user-related operations
    protected $userRepository;

    /**
     * Constructor
     *
     * @param  FreelancerRepository  $freelancerRepository  The repository handling database operations for freelancers
     * @param  UserRepository  $userRepository  The repository handling database operations for users
     */
    public function __construct(FreelancerRepository $freelancerRepository, UserRepository $userRepository)
    {
        $this->freelancerRepository = $freelancerRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Get all freelancers
     *
     */
    public function index()
    {
        // Retrieve all freelancers through the FreelancerRepository
        return $this->freelancerRepository->getAllFreelancers();
    }

    /**
     * Update a freelancer
     *
     * @param  Freelancer  $freelancer  The freelancer model instance to update
     * @param  array  $data  Data for updating the freelancer
     */
    public function update(Freelancer $freelancer, array $data)
    {
        // Update the freelancer through the FreelancerRepository
        return $this->freelancerRepository->updateFreelancer($freelancer, $data);
    }

    /**
     * Find a freelancer by ID
     *
     * @param  int  $id  ID of the freelancer
     */
    public function findById($id)
    {
        // Retrieve a freelancer by ID through the FreelancerRepository
        return $this->freelancerRepository->getFreelancerById($id);
    }

    /**
     * Delete a freelancer and associated user by freelancer model instance
     *
     * @param  Freelancer  $freelancer  The freelancer model instance to delete
     */
    public function deleteFreelancer($freelancer)
    {
        // Retrieve user_id from the freelancer model
        $user_id = $freelancer->value('user_id');

        // Retrieve the user ID associated with the freelancer
        $id = $this->userRepository->getUserById($user_id)->value('id');

        // Delete the freelancer through the FreelancerRepository
        $this->freelancerRepository->deleteFreelancer($freelancer);

        // Delete the user through the UserRepository
        $this->userRepository->deleteUser($id);
    }
}
