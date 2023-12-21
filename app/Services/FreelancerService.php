<?php

namespace App\Services;

use App\Repositories\FreelancerRepository;

class FreelancerService
{
    protected $freelancerRepository;

    public function __construct(FreelancerRepository $freelancerRepository)
    {
        $this->freelancerRepository = $freelancerRepository;
    }

    public function createFreelancer(array $data)
    {
        return $this->freelancerRepository->create($data);
    }

    public function findById($id)
    {
        return $this->freelancerRepository->findById($id);
    }

    // Add other methods as needed for freelancers
}
