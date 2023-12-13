<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDeposit extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','customer_amount', 'customer_phone', 'customer_name','payment_id', 'transaction_number', 'transaction_date', 'status'];

    public function payment_type(){
        return $this->hasMany(Pyament::class,'id','payment_id');
    }
}
