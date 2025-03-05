<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // Membuat transaksi Midtrans
    public function createTransaction(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $transaction = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'email' => $order->email,
            ],
        ];

        // Generate Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($transaction);

        return response()->json(['snap_token' => $snapToken]);
    }

    // Menangani notifikasi pembayaran Midtrans
    public function handleNotification(Request $request)
    {
        $notification = json_decode($request->getContent(), true);
        $order = Order::find($notification['order_id']);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Cek status pembayaran
        if ($notification['transaction_status'] == 'settlement') {
            $order->status = 'paid';  // Jika pembayaran sukses
        } elseif ($notification['transaction_status'] == 'expire') {
            $order->status = 'canceled';  // Jika pembayaran kadaluarsa
        } elseif ($notification['transaction_status'] == 'cancel') {
            $order->status = 'canceled';  // Jika pembayaran dibatalkan
        }

        $order->save();
        return response()->json(['message' => 'Payment status updated']);
    }
}

// mengirim jika pembayaran sukses 
// use Illuminate\Support\Facades\Mail;
// use App\Mail\TicketEmail;

// public function handleNotification(Request $request)
// {
//     $orderId = $request->order_id;
//     $status = $request->transaction_status;

//     $order = Order::find($orderId);
//     if (!$order) {
//         return response()->json(['message' => 'Order not found'], 404);
//     }

//     if ($status === 'settlement') {
//         $order->status = 'paid';
//         $order->save();

//         // Kirim email tiket
//         Mail::to($order->email)->send(new TicketEmail($order));

//         return response()->json(['message' => 'Payment status updated, ticket sent']);
//     }

//     return response()->json(['message' => 'Payment status updated']);
// }

