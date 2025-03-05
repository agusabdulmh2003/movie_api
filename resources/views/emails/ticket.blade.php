<!DOCTYPE html>
<html>
<head>
    <title>Your Movie Ticket</title>
</head>
<body>
    <h1>Thank you for your purchase!</h1>
    <p>Movie: {{ $order->movie->title }}</p>
    <p>Email: {{ $order->email }}</p>
    <p>Seats: {{ implode(', ', $order->seats) }}</p>
    <p>Total Price: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <p>Enjoy your movie!</p>
</body>
</html>
