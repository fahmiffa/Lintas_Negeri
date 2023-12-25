<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->HasOne(User::class, 'id', 'participant');
    }

    public function test()
    {
        return $this->HasOne(Test::class, 'head', 'id');
    }

    public function apply()
    {
        return $this->HasOne(Apply::class, 'head', 'id');
    }

    public function participants()
    {
        return $this->HasMany(Participant::class, 'head', 'id');
    }

    public function paid()
    {
        return $this->HasMany(Paid::class, 'head', 'id');
    }
}
