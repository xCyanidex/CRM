<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeTask
 * 
 * This model represents pivot table between employees and tasks.
 */
class EmployeeTask extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'assigned_to',
        'assigned_by',
        'task_id'
    ];
}
