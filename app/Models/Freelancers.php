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
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);   
    }
}
