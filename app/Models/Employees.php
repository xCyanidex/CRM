<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_name',
        'phone_number',
        'dob',
        'gender',
        'department_id',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'entity');
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
