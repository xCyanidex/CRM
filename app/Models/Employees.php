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
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
