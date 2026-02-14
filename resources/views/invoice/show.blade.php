<!DOCTYPE html>
<html>
<head>
    <title>Invoice Details</title>
</head>
<body>

<h2>Invoice Details</h2>

<a href="{{ route('invoice.index') }}">Back</a> |
<a href="{{ route('invoice.download', $invoice->id) }}">Download PDF</a>

<hr>

<p><strong>Invoice No:</strong> {{ $invoice->invoice_no }}</p>
<p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>

<h3>Customer Details</h3>
<p><strong>Name:</strong> {{ $invoice->customer->name }}</p>
<p><strong>Phone:</strong> {{ $invoice->customer->phone }}</p>
<p><strong>Address:</strong> {{ $invoice->customer->address }}</p>

<hr>

<h3>Services</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>#</th>
        <th>Service</th>
        <th>Rate</th>
        <th>Hours</th>
        <th>Total</th>
    </tr>

    @foreach($invoice->items as $key => $item)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $item->service->name }}</td>
        <td>₹ {{ $item->rate }}</td>
        <td>{{ $item->hours }}</td>
        <td>₹ {{ $item->total }}</td>
    </tr>
    @endforeach
</table>

<hr>

<h3>Summary</h3>
<p><strong>Subtotal:</strong> ₹ {{ $invoice->subtotal }}</p>
<p><strong>Discount:</strong> ₹ {{ $invoice->discount }}</p>
<p><strong>Tax:</strong> ₹ {{ $invoice->tax }}</p>
<p><strong>Grand Total:</strong> ₹ {{ $invoice->grand_total }}</p>

</body>
</html>
