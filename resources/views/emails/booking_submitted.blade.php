<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #334155; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 16px; border: 1px solid #e2e8f0; }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; }
        .badge { background: #f0fdfa; color: #0d9488; font-weight: bold; padding: 6px 12px; border-radius: 20px; font-size: 12px; }
        .footer { text-align: center; margin-top: 30px; font-size: 11px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Siang<span style="color:#0d9488;">Explorer</span></h2>
            <span class="badge">Booking Request Received</span>
        </div>
        <p>Dear {{ $booking->customer_name }},</p>
        <p>Thank you for choosing SiangExplorer! We have received your booking request for <strong>{{ $booking->tourPackage->title ?? 'Tour Package' }}</strong>.</p>
        
        <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
        <p><strong>Travel Date:</strong> {{ $booking->travel_date->format('d M Y') }}</p>
        <p><strong>Total Amount:</strong> ₹{{ number_format($booking->final_amount, 2) }}</p>

        <p>Our travel concierge team will review your reservation and contact you shortly.</p>
        
        <div class="footer">
            <p>© {{ date('Y') }} SiangExplorer. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
