<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class GoogleToken extends Model
{
  
  	protected $table = "google_tokens";
  
    protected $fillable = [
        'customer_id',
      	'token',
    ];
  
  public function customer(){
    return $this->belongsTo(Customer::class,'customer_id','id');
  }

  	
}
