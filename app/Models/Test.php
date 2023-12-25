<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function exam()
    {
        return $this->HasOne(Exam::class,'id','exams_id');
    }
}
