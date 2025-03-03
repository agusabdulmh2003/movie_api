<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_id', 'seat_id', 'status', 'total_price'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
