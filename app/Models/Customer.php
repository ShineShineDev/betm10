<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\GoogleToken;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'image',
        'password',
        'referral_code',
        'referral_id',
        'type',
        'fcm_token_key',
        'security_code',
        'friend_code',
        'balance',
        'deposit',
        'is_suspended',
        'last_logined_at',
        'last_logined_at'
    ];
  	
     public function googleTokens(){
          return $this->hasMany(GoogleToken::class,'customer_id','id');
     }

}
