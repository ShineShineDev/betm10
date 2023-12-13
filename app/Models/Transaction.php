<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ["transaction_id", "customer_id", "type", "amount", "payer_account_phone", "payer_account_name", "payment_transaction_id", "receiver_account_phone", "receiver_account_name", "payment_id", "duration", "note", "status","transaction_model","transaction_type"];
}
