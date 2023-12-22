<?php

namespace App\Repositories;

use App\Models\Freelancer;

use App\Interfaces\FreelancerRepositoryInterface;

class FreelancerRepository implements FreelancerRepositoryInterface
{
    protected $freelancer;

    public function __construct(Freelancer $freelancer)
    {
        $this->freelancer = $freelancer;
    }

    public function createFreelancer(array $data)
    {
        return $this->freelancer->create($data);
    }

    public function getAllFreelancers()
        {
            return $this->freelancer->all();
        }

   
    public function getFreelancerById($id)
        {
            return $this->freelancer->find($id);
        }

    public function updateFreelancer($freelancer, array $data)
    {
        return $freelancer->update($data);
    }


    public function deleteFreelancer($id)
        {
            return $this->freelancer->destroy($id);
        }

    // Add more specific methods as needed for the Freelancer model
}
