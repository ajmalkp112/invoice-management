<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
  public function index()
  {
    $invoices = Invoice::with('customer')->latest()->get();
    return view('invoice.index', compact('invoices'));
  }

  public function create()
  {
    $customers = Customer::all();
    $services = Service::all();
    return view('invoice.create', compact('customers', 'services'));
  }

  public function store(Request $request)
  {
    $subtotal = 0;

    foreach ($request->service_id as $key => $serviceId) {
      $rate = Service::find($serviceId)->hourly_rate;
      $hours = $request->hours[$key];
      $subtotal += ($rate * $hours);
    }

    $discount = $request->discount ?? 0;
    $tax = ($subtotal - $discount) * 0.05;
    $grandTotal = $subtotal - $discount + $tax;

    $invoice = Invoice::create([
      'invoice_no' => 'INV' . time(),
      'customer_id' => $request->customer_id,
      'invoice_date' => now(),
      'subtotal' => $subtotal,
      'discount' => $discount,
      'tax' => $tax,
      'grand_total' => $grandTotal
    ]);

    foreach ($request->service_id as $key => $serviceId) {
      $rate = Service::find($serviceId)->hourly_rate;
      $hours = $request->hours[$key];

      InvoiceItem::create([
        'invoice_id' => $invoice->id,
        'service_id' => $serviceId,
        'rate' => $rate,
        'hours' => $hours,
        'total' => $rate * $hours
      ]);
    }

    return redirect()->route('invoice.index');
  }

  public function show($id)
  {
    $invoice = Invoice::with('items.service', 'customer')
      ->findOrFail($id);

    return view('invoice.show', compact('invoice'));
  }


  public function download($id)
  {
    $invoice = Invoice::with('items.service', 'customer')->findOrFail($id);

    $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));
    return $pdf->download('invoice-' . $invoice->invoice_no . '.pdf');
  }
}
