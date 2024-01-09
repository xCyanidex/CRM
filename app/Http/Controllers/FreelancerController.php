<?php

/**
 * FreelancerController
 * 
 * This controller handles requests related to freelancer operations, such as fetching all freelancers,
 * retrieving a specific freelancer by ID, updating a freelancer, and deleting a freelancer.
 * It utilizes the FreelancerService to perform business logic operations.
 *
 *
 * @category Controller
 * @package  App\Http\Controllers
 */


namespace App\Http\Controllers;

use App\Services\FreelancerService;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    // Instance of the FreelancerService for business logic handling
    protected $freelancerService;

    /**
     * Constructor
     *
     * @param  FreelancerService  $freelancerService  The service responsible for freelancer-related operations
     */
    public function __construct(FreelancerService $freelancerService)
    {
        $this->freelancerService = $freelancerService;
    }

    /**
     * Get all freelancers
     *
     */
    public function getAll()
    {
        // Retrieve all freelancers through the FreelancerService
        $freelancers = $this->freelancerService->index();

        // Check if no freelancers are found
        if (!$freelancers) {
            return response()->json(['message' => 'No Freelancer Found in Database'], 404);
        } else {
            // Return a JSON response with the fetched freelancers
            return response()->json(['Freelancers' => $freelancers], 200);
        }
    }

    /**
     * Get a specific freelancer by ID
     *
     * @param  int  $id  ID of the freelancer
     */
    public function show($id)
    {
        // Retrieve a freelancer by ID through the FreelancerService
        $freelancer = $this->freelancerService->findById($id);

        // Check if the freelancer is not found
        if (!$freelancer) {
            return response()->json(['message' => 'Freelancer not found'], 404);
        }

        // Return a JSON response with the fetched freelancer
        return response()->json(['Freelancer' => $freelancer], 200);
    }

    /**
     * Update a freelancer by ID
     *
     * @param  Request  $request  HTTP request containing the update data
     * @param  int  $id  ID of the freelancer to update
     */
    public function update(Request $request, $id)
    {
        // Retrieve a freelancer by ID through the FreelancerService
        $freelancer = $this->freelancerService->findById($id);

        // Check if the freelancer is not found
        if (!$freelancer) {
            return response()->json(['message' => 'Freelancer not found'], 404);
        } else {
            // Get request data and update the freelancer through the FreelancerService
            $data = $request->all();
            $this->freelancerService->update($freelancer, $data);
        }

        // Return a JSON response indicating the successful update
        return response()->json(['message' => 'Freelancer updated'], 200);
    }

    /**
     * Delete a freelancer by ID
     *
     * @param  int  $id  ID of the freelancer to delete
     */
    public function destroy($id)
    {
        // Retrieve a freelancer by ID through the FreelancerService
        $freelancer = $this->freelancerService->findById($id);

        // Check if the freelancer is not found
        if (!$freelancer) {
            return response()->json(['message' => 'Freelancer not found'], 404);
        } else {
            // Delete the freelancer through the FreelancerService
            $this->freelancerService->deleteFreelancer($freelancer);
        }

        // Return a JSON response indicating the successful deletion
        return response()->json(['message' => 'Freelancer deleted successfully']);
    }
}
