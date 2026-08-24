<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #334155; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 16px; border: 1px solid #e2e8f0; }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; }
        .badge { background: #ecfdf5; color: #047857; font-weight: bold; padding: 6px 12px; border-radius: 20px; font-size: 12px; }
        .footer { text-align: center; margin-top: 30px; font-size: 11px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Siang<span style="color:#0d9488;">Explorer</span></h2>
            <span class="badge">Booking Confirmed</span>
        </div>
        <p>Dear {{ $booking->customer_name }},</p>
        <p>Great news! Your booking for <strong>{{ $booking->tourPackage->title ?? 'Tour Package' }}</strong> has been officially confirmed.</p>
        
        <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
        <p><strong>Travel Date:</strong> {{ $booking->travel_date->format('d M Y') }}</p>

        <p>You can access your complete invoice and itinerary vouchers by logging into your customer account portal.</p>
        
        <div class="footer">
            <p>© {{ date('Y') }} SiangExplorer. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
