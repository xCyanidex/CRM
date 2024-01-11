<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = [
        'employee_name',
        'phone_number',
        'dob',
        'gender',
        'department_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
    // public function task(){
    //     return $this->belongsToMany(Task::class,'assigned_to','assigned_by','task_id');
    // }
    public function task(){
        return $this->belongsToMany(Task::class)->withPivot('assigned_to','assigned_by','task_id')->withTimestamps();
    }
}
