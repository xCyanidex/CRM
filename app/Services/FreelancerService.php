<?php

namespace App\Services;

use App\Repositories\FreelancerRepository;
use App\Repositories\UserRepository;
use App\Models\Freelancer;

class FreelancerService
{
    protected $freelancerRepository;
    protected $userRepository;

    public function __construct(FreelancerRepository $freelancerRepository, UserRepository $userRepository)
    {
        $this->freelancerRepository = $freelancerRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
        {
            return $this->freelancerRepository->getAllFreelancers();
           
        }

    public function update(Freelancer $freelancer, array $data)
        {
            return $this->freelancerRepository->updateFreelancer($freelancer, $data);
        }

    public function findById($id)
    {
        return $this->freelancerRepository->getFreelancerById($id);
    }

    public function deleteFreelancer($freelancer)
        {
            $user_id = $freelancer->value('user_id');
            $id = $this->userRepository->getUserById($user_id)->value('id');
            $this->freelancerRepository->deleteFreelancer($freelancer);
           
            $this->userRepository->deleteUser($id);

        }

    
}
