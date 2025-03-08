<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rateMovie(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = Rating::updateOrCreate(
            ['user_id' => Auth::id(), 'movie_id' => $id],
            ['rating' => $request->rating]
        );

        return response()->json(['message' => 'Rating berhasil disimpan', 'data' => $rating]);
    }

    public function getMovieRatings($id)
    {
        $averageRating = Rating::where('movie_id', $id)->avg('rating');

        return response()->json(['movie_id' => $id, 'average_rating' => $averageRating]);
    }
    public function getRecommendedMovies()
{
    $movies = Movie::withAvg('ratings', 'rating')
                   ->orderByDesc('ratings_avg_rating')
                   ->take(5)
                   ->get();

    return response()->json(['recommended_movies' => $movies]);
}
public function getTrendingMovies()
{
    $movies = Movie::withCount('orders')
                   ->orderByDesc('orders_count')
                   ->take(5)
                   ->get();

    return response()->json(['trending_movies' => $movies]);
}


}

