<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report PDF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Base styling */
        body { 
            font-family: Arial, sans-serif; 
            color: #333; 
            line-height: 1.6; 
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }
        
        /* Header */
        .header {
            text-align: center;
            color: #444;
            border-bottom: 2px solid #ff4d4d; /* Red accent */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #ff4d4d; /* Red */
            margin: 0;
        }

        /* Section styling */
        .section {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .section h2 {
            font-size: 18px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        /* Labels and content styling */
        .label {
            color: #666;
            font-weight: bold;
            margin-right: 5px;
        }
        .content {
            color: #333;
            font-size: 14px;
        }

        /* Signature section */
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #555;
            padding-top: 15px;
            border-top: 2px solid #ddd;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature-section div {
            width: 45%;
            text-align: center;
        }
        .signature-line {
            margin-top: 30px;
            border-top: 1px solid #aaa;
            padding-top: 5px;
            font-size: 12px;
            color: #777;
        }

        /* Icons */
        .icon {
            color: #ff4d4d; /* Red color for icons */
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Report #{{ $report->id }}</h1>
            <p><em>Prepared for {{ $report->charity->charity_name }}</em></p>
        </div>
        
        <!-- Report Details Section -->
        <div class="section">
            <p><i class="fas fa-file-alt icon"></i><span class="label">Type:</span> <span class="content">{{ ucfirst($report->report_type) }}</span></p>
            <p><i class="fas fa-calendar-alt icon"></i><span class="label">Date:</span> <span class="content">{{ $report->report_date->format('d/m/Y') }}</span></p>
            <p><i class="fas fa-building icon"></i><span class="label">Charity:</span> <span class="content">{{ $report->charity->charity_name }}</span></p>
        </div>

        <!-- Report Content Section -->
        <div class="section">
            <h2>Content</h2>
            <p class="content">{{ $report->content }}</p>
        </div>
        
        <!-- Signature Section -->
        <div class="signature-section">
            <div>
                <p class="signature-line"><i class="fas fa-calendar-check icon"></i>Date: {{ now()->format('d/m/Y') }}</p>
            </div>
            <div>
                <p class="signature-line">Authorized Signature: <br>____________________</p>
                <p class="content">Society Representative</p>
            </div>
        </div>
    </div>
</body>
</html>
