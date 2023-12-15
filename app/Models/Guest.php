<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserv_id',
        'date_in',
        'date_out',
        'name',
        'surname',
        'patronymic',
        'address',
        'number',
        'passport'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reserv_id');
    }
}
