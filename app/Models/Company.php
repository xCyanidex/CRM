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
    ];

    public function users()
    {
        return $this->morphMany(User::class, 'entity');
    }
    
    public function departments(){
        return $this->hasMany(Department::class);
    }
}
