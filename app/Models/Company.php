<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'business_type',
        'industry',
        'registration_number',
        'website',
        'logo',
        'user_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
    public function employees(){
        return $this->hasMany(Employees::class);
    }
    public function departments(){
        return $this->hasMany(Department::class);
    }
}
