<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class Employee
 * 
 * This model represents an employee.
 */
class Employee extends Model
{
    use HasFactory, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_name',
        'phone_number',
        'dob',
        'gender',
        'department_id',
        'user_id'
    ];

    /**
     * Get the user associated with the employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department associated with the employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
<<<<<<< HEAD
    // public function task(){
    //     return $this->belongsToMany(Task::class,'assigned_to','assigned_by','task_id');
    // }
    public function task(){
        return $this->belongsToMany(Task::class)->withPivot('assigned_to','assigned_by','task_id')->withTimestamps();
=======

    /**
     * Get the tasks associated with the employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'assigned_to', 'assigned_by', 'task_id');
>>>>>>> 5870710ed1728e723a1b1839f83f3f1ee8ae0137
    }
}
