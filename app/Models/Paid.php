<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    use HasFactory;

    public function kelas()
    {
        return $this->HasOne(Kelas::class, 'id', 'par');
    }

    public function users()
    {
        return $this->HasOne(User::class, 'id', 'user');
    }
}
