<form method="POST" action="{{ route('invoice.store') }}">
@csrf

<select name="customer_id">
@foreach($customers as $customer)
<option value="{{ $customer->id }}">{{ $customer->name }}</option>
@endforeach
</select>

<table>
<tr>
<th>Service</th>
<th>Hours</th>
</tr>

@foreach($services as $service)
<tr>
<td>
<select name="service_id[]">
<option value="{{ $service->id }}">
{{ $service->name }} (₹{{ $service->hourly_rate }})
</option>
</select>
</td>

<td>
<input type="number" name="hours[]" min="1">
</td>
</tr>
@endforeach
</table>

<input type="number" name="discount" placeholder="Discount">
<button type="submit">Save</button>

</form>
