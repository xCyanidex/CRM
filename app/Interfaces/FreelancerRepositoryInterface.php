<?php

/**
 * FreelancerRepositoryInterface
 * 
 * This interface defines the contract for repository classes that handle database operations
 * related to the Freelancer model. Classes implementing this interface are expected to provide
 * implementations for methods such as creating, retrieving, updating, and deleting freelancers.
 *
 *
 * @category Interface
 * @package  App\Interfaces
 */

namespace App\Interfaces;

use App\Models\Freelancer;

interface FreelancerRepositoryInterface
{
    /**
     * Create a new freelancer
     *
     * @param  array  $data  Data for creating a new freelancer
     */
    public function createFreelancer(array $data);

    /**
     * Get all freelancers
     *
     */
    public function getAllFreelancers();


    /**
     * Get a freelancer by its ID
     *
     * @param  int  $id  ID of the freelancer
     */
    public function getFreelancerById($id);

    /**
     * Update a freelancer by model instance
     *
     * @param  Freelancer  $freelancer  The freelancer model instance to update
     * @param  array  $data  Data for updating the freelancer
     */
    public function updateFreelancer(Freelancer $freelancer, array $data);

    /**
     * Delete a freelancer by ID
     *
     * @param  int  $id  ID of the freelancer to delete
     */
    public function deleteFreelancer($id);
}
