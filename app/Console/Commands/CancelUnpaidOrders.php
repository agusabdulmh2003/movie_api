<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class CancelUnpaidOrders extends Command
{
    protected $signature = 'orders:cancel-unpaid';
    protected $description = 'Membatalkan order yang tidak dibayar dalam 7 menit';

    public function handle()
    {
        $orders = Order::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(7))
            ->get();

        foreach ($orders as $order) {
            $order->status = 'canceled';
            $order->save();
        }

        $this->info('Order yang tidak dibayar dalam 7 menit telah dibatalkan.');
    }
}
