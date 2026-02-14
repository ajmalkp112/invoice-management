<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .container {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px 0;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.items th,
        table.items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        table.items th {
            background-color: #f2f2f2;
        }

        .totals {
            width: 40%;
            float: right;
            margin-top: 20px;
        }

        .totals table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals td {
            padding: 6px;
            border: 1px solid #ccc;
        }

        .totals .label {
            text-align: left;
        }

        .totals .value {
            text-align: right;
        }

        .grand-total {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>SPORTS TURF FACILITY</h2>
        <p>Invoice</p>
    </div>

    <!-- Invoice Info -->
    <table class="info-table">
        <tr>
            <td><strong>Invoice No:</strong> {{ $invoice->invoice_no }}</td>
            <td><strong>Date:</strong> {{ $invoice->invoice_date }}</td>
        </tr>
        <tr>
            <td><strong>Customer:</strong> {{ $invoice->customer->name }}</td>
            <td><strong>Phone:</strong> {{ $invoice->customer->phone }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Address:</strong> {{ $invoice->customer->address }}
            </td>
        </tr>
    </table>

    <!-- Service Table -->
    <table class="items">
        <thead>
            <tr>
                <th>#</th>
                <th>Service</th>
                <th>Rate (₹)</th>
                <th>Hours</th>
                <th>Total (₹)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->service->name }}</td>
                <td>{{ number_format($item->rate, 2) }}</td>
                <td>{{ $item->hours }}</td>
                <td>{{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals Section -->
    <div class="totals">
        <table>
            <tr>
                <td class="label">Subtotal</td>
                <td class="value">₹ {{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Discount</td>
                <td class="value">₹ {{ number_format($invoice->discount, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Tax (5%)</td>
                <td class="value">₹ {{ number_format($invoice->tax, 2) }}</td>
            </tr>
            <tr class="grand-total">
                <td class="label">Grand Total</td>
                <td class="value">₹ {{ number_format($invoice->grand_total, 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="footer">
        Thank you for choosing our Sports Turf Facility!
    </div>

</div>

</body>
</html>
