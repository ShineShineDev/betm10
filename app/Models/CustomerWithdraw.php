<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerWithdraw extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'customer_amount', 'customer_phone', 'customer_name', 'payment_id','withdraw_date', 'status'];

    public function payment_type()
    {
        return $this->hasMany(Pyament::class, 'id', 'payment_id');
    }
}
