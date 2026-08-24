<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #334155; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 16px; border: 1px solid #e2e8f0; }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Siang<span style="color:#0d9488;">Explorer</span> Lead Notification</h2>
        </div>
        <p>A new customer enquiry has been submitted on the website.</p>
        
        <p><strong>Customer Name:</strong> {{ $enquiry->name }}</p>
        <p><strong>Email:</strong> {{ $enquiry->email }}</p>
        <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
        <p><strong>Message:</strong> {{ $enquiry->message }}</p>
        
        <p>Please log in to the admin portal to assign a staff member and update the lead status.</p>
    </div>
</body>
</html>
