<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice #{{ $invoice->id }}</h1>
    <p><strong>Client:</strong> {{ $invoice->client->client_name }}</p>
    <p><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</p>
    <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
</body>
</html>
