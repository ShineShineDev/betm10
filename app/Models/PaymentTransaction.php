<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'customer_amount', 'customer_phone', 'customer_name', 'payment_id', 'transaction_number', 'date', 'status','type'];

    public function payment_type()
    {
        return $this->hasOne(Pyament::class, 'id', 'payment_id');
    }
}
