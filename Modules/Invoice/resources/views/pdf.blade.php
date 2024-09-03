<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .invoice-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            margin: auto;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .company-details {
            text-align: right;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }
        .company-address {
            font-size: 14px;
            line-height: 1.6;
            color: #555;
        }
        .invoice-details {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .invoice-details span {
            color: #007BFF;
        }
        .client-details {
            margin-bottom: 40px;
        }
        .client-details p {
            margin: 0;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .client-details strong {
            color: #333;
        }
        .amount-due {
            font-size: 28px;
            font-weight: bold;
            color: #007BFF;
            margin-bottom: 20px;
        }
        .invoice-footer {
            margin-top: 60px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-details">
                <div class="company-name">Streamline Health Tech</div>
                <div class="company-address">
                    123 Business Road<br>
                    Business City, BC 12345<br>
                    Phone: (123) 456-7890<br>
                    Email: info@greatcompany.com
                </div>
            </div>
        </div>

        <div class="invoice-details">
            Invoice #<span>{{ $invoice->id }}</span>
        </div>

        <div class="client-details">
            <p><strong>Client Name:</strong> {{ $invoice->client->client_name }}</p>
            <p><strong>Client Address:</strong> {{ $invoice->client->location }}</p>
        </div>

        <div class="amount-due">
            Amount Due: ${{ number_format($invoice->amount, 2) }}
        </div>

        <div class="client-details">
            <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
        </div>

        <div class="invoice-footer">
            Thank you for your business. Please make payment by the due date.
        </div>
    </div>
</body>
</html>
