<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThaiDBettingLog extends Model
{
    use HasFactory;
    protected $fillable = [
        "thaid_section_id",
        "thaid_bet_slip_id",
        "customer_id",
        "slip_number",
        "bet_number",
        "reward_amount",
        "rewrad_status",
    ];
}







