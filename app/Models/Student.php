<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function lpk()
    {
        return $this->HasOne(User::class, 'id', 'lpk');
    }

    public function siswa()
    {
        return $this->HasOne(User::class, 'id', 'student');
    }
}
