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

    public function create(array $data)
    {
        return $this->freelancer->create($data);
    }

    public function update(Freelancer $freelancer, array $data)
    {
        return $freelancer->update($data);
    }

    public function delete(Freelancer $freelancer)
    {
        return $freelancer->delete();
    }

    public function findById($id)
    {
        return $this->freelancer->find($id);
    }

    // Add more specific methods as needed for the Freelancer model
}
