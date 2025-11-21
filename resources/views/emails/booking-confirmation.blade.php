<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 32px; }
        .header h2 { margin: 10px 0 0 0; font-size: 24px; font-weight: normal; }
        .content { padding: 30px; }
        .booking-details { background: #f9fafb; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #667eea; }
        .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-weight: bold; color: #6b7280; }
        .detail-value { color: #111827; font-weight: 600; }
        .status-badge { background: #fbbf24; color: white; padding: 8px 16px; border-radius: 20px; display: inline-block; font-weight: bold; }
        .footer { background: #1f2937; color: white; padding: 20px; text-align: center; }
        .footer p { margin: 5px 0; }
        ul { padding-left: 20px; }
        ul li { margin: 8px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎬 MovieServe</h1>
            <h2>Booking Confirmation</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $booking->user->name }},</p>
            
            <p>Thank you for your movie booking! Your reservation has been received and is currently <strong>pending admin approval</strong>.</p>
            
            <div class="booking-details">
                <h3 style="margin-top: 0; color: #667eea;">Booking Details</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Movie:</span>
                    <span class="detail-value">{{ $booking->movie->title }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Showtime:</span>
                    <span class="detail-value">{{ $booking->showtime }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Seats:</span>
                    <span class="detail-value">{{ implode(', ', $booking->seats) }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Number of Seats:</span>
                    <span class="detail-value">{{ count($booking->seats) }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Total Price:</span>
                    <span class="detail-value">₱{{ $booking->total_price }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="status-badge">Pending Approval</span>
                </div>
            </div>
            
            <p><strong>What's Next?</strong></p>
            <ul>
                <li>Our admin will review your booking shortly</li>
                <li>You'll receive another email once your booking is approved</li>
                <li>Keep an eye on your inbox for updates</li>
                <li>You can check your booking status in your profile</li>
            </ul>
            
            <p>If you have any questions, please don't hesitate to contact us.</p>
            
            <p>Best regards,<br><strong>The MovieServe Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 MovieServe. All rights reserved.</p>
            <p style="font-size: 12px; margin-top: 10px;">This is an automated email. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
