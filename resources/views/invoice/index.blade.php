<!DOCTYPE html>
<html>
<head>
    <title>Invoice List</title>
</head>
<body>

<h2>Invoice List</h2>

<a href="{{ route('invoice.create') }}">Create New Invoice</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Invoice No</th>
        <th>Customer</th>
        <th>Date</th>
        <th>Grand Total</th>
        <th>Action</th>
    </tr>

    @foreach($invoices as $invoice)
    <tr>
        <td>{{ $invoice->invoice_no }}</td>
        <td>{{ $invoice->customer->name }}</td>
        <td>{{ $invoice->invoice_date }}</td>
        <td>₹ {{ $invoice->grand_total }}</td>
        <td>
            <a href="{{ route('invoice.show', $invoice->id) }}">View</a> |
            <a href="{{ route('invoice.download', $invoice->id) }}">Download</a>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>
