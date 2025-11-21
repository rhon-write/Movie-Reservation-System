<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Approved</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 32px; }
        .header h2 { margin: 10px 0 0 0; font-size: 24px; font-weight: normal; }
        .checkmark { font-size: 48px; margin-bottom: 10px; }
        .content { padding: 30px; }
        .booking-details { background: #f9fafb; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #10b981; }
        .detail-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-weight: bold; color: #6b7280; }
        .detail-value { color: #111827; font-weight: 600; }
        .status-badge { background: #10b981; color: white; padding: 8px 16px; border-radius: 20px; display: inline-block; font-weight: bold; }
        .success-box { background: #d1fae5; border-left: 4px solid #10b981; padding: 15px; margin: 20px 0; border-radius: 4px; color: #065f46; }
        .footer { background: #1f2937; color: white; padding: 20px; text-align: center; }
        .footer p { margin: 5px 0; }
        ul { padding-left: 20px; }
        ul li { margin: 8px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="checkmark">✅</div>
            <h1>🎬 MovieServe</h1>
            <h2>Booking Approved!</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $booking->user->name }},</p>
            
            <div class="success-box">
                <strong>Great news!</strong> Your movie booking has been approved by our admin team.
            </div>
            
            <p>Your reservation is now <strong>confirmed</strong>. Get ready for an amazing movie experience!</p>
            
            <div class="booking-details">
                <h3 style="margin-top: 0; color: #10b981;">Confirmed Booking Details</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Movie:</span>
                    <span class="detail-value">{{ $booking->movie->title }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Showtime:</span>
                    <span class="detail-value">{{ $booking->showtime }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Your Seats:</span>
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
                    <span class="status-badge">Approved ✓</span>
                </div>
            </div>
            
            <p><strong>Important Reminders:</strong></p>
            <ul>
                <li>Please arrive at least 15 minutes before the showtime</li>
                <li>Bring this email or show your booking confirmation</li>
                <li>Your seats are: <strong>{{ implode(', ', $booking->seats) }}</strong></li>
                <li>Showtime: <strong>{{ $booking->showtime }}</strong></li>
            </ul>
            
            <p>We hope you enjoy the movie! Thank you for choosing MovieServe.</p>
            
            <p>Best regards,<br><strong>The MovieServe Team</strong></p>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 MovieServe. All rights reserved.</p>
            <p style="font-size: 12px; margin-top: 10px;">This is an automated email. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
