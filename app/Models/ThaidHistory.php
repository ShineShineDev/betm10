<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThaidHistory extends Model
{
    use HasFactory;
    protected $fillable = ["customer_id", "bet_number","price"];
}
