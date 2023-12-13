<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwodCalendar extends Model
{
    use HasFactory;
    protected $fillable = ["morning_modern","morning_internet","morning_number","evening_modern","evening_internet","evening_number"];
}
