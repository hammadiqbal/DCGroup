<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1b1b18;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #1b1b18;
            margin-bottom: 5px;
        }
        .field-value {
            color: #666;
            padding: 10px;
            background-color: white;
            border-radius: 4px;
            border: 1px solid #e3e3e0;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Contact Form Submission</h2>
    </div>
    <div class="content">
        <div class="field">
            <div class="field-label">Name:</div>
            <div class="field-value">{{ $contact->name }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Email:</div>
            <div class="field-value">{{ $contact->email }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Subject:</div>
            <div class="field-value">{{ $contact->subject }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Message:</div>
            <div class="field-value" style="white-space: pre-wrap;">{{ $contact->message }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Submitted At:</div>
            <div class="field-value">{{ $contact->created_at->format('F j, Y, g:i a') }}</div>
        </div>
        
        @if($contact->ip)
        <div class="field">
            <div class="field-label">IP Address:</div>
            <div class="field-value">{{ $contact->ip }}</div>
        </div>
        @endif
    </div>
    
    <div class="footer">
        <p>This is an automated message from {{ config('app.name') }} Contact Form.</p>
    </div>
</body>
</html>

