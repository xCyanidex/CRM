<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'start_time',
        'end_time',
        'status',
    ];
    public function employee(){
        return $this->belongsToMany(Employee::class,'assigned_to','assigned_by','task_id');
    }
}
