<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public function exam()
    {
        return $this->HasOne(Exam::class, 'kelas_id', 'id');
    }

    public function paid()
    {
        return $this->belongsTo(Paid::class, 'id', 'par');
    }
}
