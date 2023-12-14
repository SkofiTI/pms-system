<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
