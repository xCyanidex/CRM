<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancers extends Model
{
    use HasFactory;
    protected $fillable=[
        'freelancer_name',
        'industry',
    ];
    
    public function user()
    {
        return $this->morphOne(User::class, 'entity');
    }
}
