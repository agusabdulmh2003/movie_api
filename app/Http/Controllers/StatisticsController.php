<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Movie;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function movieSales()
    {
        $sales = Movie::withCount('orders')->get();
        return response()->json($sales);
    }

    public function dailySales()
    {
        $sales = Order::whereDate('created_at', Carbon::today())->count();
        return response()->json(['daily_sales' => $sales]);
    }

    public function monthlyRevenue()
    {
        $revenue = Order::whereMonth('created_at', Carbon::now()->month)->sum('total_price');
        return response()->json(['monthly_revenue' => $revenue]);
    }

    public function movieViewers()
    {
        $viewers = Movie::withCount('orders')->orderByDesc('orders_count')->get();
        return response()->json(['viewers_per_movie' => $viewers]);
    }
}

