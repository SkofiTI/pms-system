<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'date_in',
        'date_out',
        'status'
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
