<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Employees;

class Department extends Model
{
    use HasFactory;
    

    protected $fillable=['department_name'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function employees(){
        return $this->hasMany(Employees::class);
    }

}
