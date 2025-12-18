<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .code { font-size: 32px; font-weight: bold; color: #667eea; text-align: center; padding: 20px; background: #f0f0f0; border-radius: 10px; letter-spacing: 5px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #667eea;">KoreaCars</h1>
            <h2>Email Verification</h2>
        </div>
        
        <p>Hello {{ $userName }},</p>
        <p>Thank you for registering with KoreaCars! Please use the verification code below to complete your registration:</p>
        
        <div class="code">{{ $code }}</div>
        
        <p style="text-align: center; margin-top: 20px; color: #666;">This code will expire in 10 minutes.</p>
        
        <p>If you didn't create an account with KoreaCars, please ignore this email.</p>
        
        <div class="footer">
            <p>© 2025 KoreaCars. All rights reserved.</p>
        </div>
    </div>
</body>
</html>