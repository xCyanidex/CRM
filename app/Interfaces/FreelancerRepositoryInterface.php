<?php

namespace App\Interfaces;
use App\Models\Freelancer;

interface FreelancerRepositoryInterface
{
    public function createFreelancer(array $data);
    public function getAllFreelancers();
    public function getFreelancerById($id);
    public function updateFreelancer(Freelancer $freelancer, array $data);
    public function deleteFreelancer($id);
 
}
