<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #2d5016; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .body { background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
        .otp-code { font-size: 32px; font-weight: bold; color: #2d5016; text-align: center; padding: 20px; background-color: white; border-radius: 5px; margin: 20px 0; letter-spacing: 5px; }
        .footer { background-color: #f0f0f0; padding: 15px; text-align: center; font-size: 12px; color: #666; border-radius: 0 0 5px 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>OTP Verification Code</h2>
        </div>
        <div class="body">
            <p>Hello {{ $username }},</p>
            <p>Your OTP verification code for the MPSU Alumni Network is:</p>
            
            <div class="otp-code">{{ $otpCode }}</div>
            
            <p>This code will expire in <strong>10 minutes</strong>. Do not share this code with anyone.</p>
            <p>If you did not request this code, please ignore this email.</p>
            <br>
            <p>Thank you,<br>{{ config('app.name') }} Team</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} MPSU Alumni Network. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
