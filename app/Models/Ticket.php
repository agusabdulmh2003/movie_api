<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'customer_name', 'seat_number'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
