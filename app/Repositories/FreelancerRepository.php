<?php

/**
 * FreelancerRepository
 * 
 * This repository class provides an abstraction for 
 * database operations related to the Freelancer model.
 * 
 * It implements the FreelancerRepositoryInterface and interacts 
 * with the underlying Freelancer model.
 *
 *
 * @category Repository
 * @package  App\Repositories
 */

namespace App\Repositories;

use App\Models\Freelancer;
use App\Interfaces\FreelancerRepositoryInterface;

class FreelancerRepository implements FreelancerRepositoryInterface
{
    // Instance of the Freelancer model
    protected $freelancer;

    /**
     * Constructor
     *
     * @param  Freelancer  $freelancer  The Freelancer model instance
     */
    public function __construct(Freelancer $freelancer)
    {
        $this->freelancer = $freelancer;
    }

    /**
     * Create a new freelancer
     *
     * @param  array  $data  Data for creating a new freelancer
     */
    public function createFreelancer(array $data)
    {
        return $this->freelancer->create($data);
    }

    /**
     * Get all freelancers
     *
     */
    public function getAllFreelancers()
    {
        return $this->freelancer->all();
    }

    /**
     * Get a freelancer by its ID
     *
     * @param  int  $id  ID of the freelancer
     */
    public function getFreelancerById($id)
    {
        return $this->freelancer->find($id);
    }

    /**
     * Update a freelancer by model instance
     *
     * @param  Freelancer  $freelancer  The freelancer model instance to update
     * @param  array  $data  Data for updating the freelancer
     */
    public function updateFreelancer($freelancer, array $data)
    {
        return $freelancer->update($data);
    }

    /**
     * Delete a freelancer by ID
     *
     * @param  int  $id  ID of the freelancer to delete
     */
    public function deleteFreelancer($id)
    {
        return $this->freelancer->destroy($id);
    }

    // Add more specific methods as needed for the Freelancer model
}
