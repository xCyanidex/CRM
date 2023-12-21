<?php

namespace App\Interfaces;

interface FreelancerRepositoryInterface
{
    public function createFreelancer(array $data);
    public function getAllFreelancers();
    public function getFreelancerById($id);
    public function updateFreelancer($id, array $data);
    public function deleteFreelancer($id);
    public function findByEmail($email);
}
