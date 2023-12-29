<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apply extends Model
{
    use HasFactory, SoftDeletes;

    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'jobs_id');   
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');   
    }
}
