<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['seat_number', 'is_reserved', 'movie_id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
