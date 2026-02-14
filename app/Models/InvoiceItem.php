<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{

  protected $fillable = [
    'invoice_id',
    'service_id',
    'rate',
    'hours',
    'total'
  ];

  public function service()
  {
    return $this->belongsTo(Service::class);
  }
}
