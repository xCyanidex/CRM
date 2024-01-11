<?php

/**
 * Task Model
 *
 * This Eloquent model represents the 'tasks' table in the database.
 * It extends the base Model class and uses the HasFactory trait for factory support.
 *
 * @package App\Models
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    
    /**
     * The attributes that are mass assignable.
     *
     * These attributes can be filled using mass assignment methods like create or update.
     *
     * @var array
     */
    protected $fillable=[
        'title',
        'description',
        'start_time',
        'end_time',
        'status',
    ];
    
    
    /**
     * Define a many-to-many relationship with the Employee model.
     *
     * This method establishes a many-to-many relationship between Task and Employee models.
     * The 'withPivot' method allows access to additional columns in the pivot table (assigned_by, assigned_to, task_id).
     * The 'withTimestamps' method automatically manages the created_at and updated_at columns in the pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employee(){
        return $this->belongsToMany(Employee::class)->withPivot('assigned_by','assigned_to','task_id')->withTimestamps();
    }
}
