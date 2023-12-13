<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDBettingLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'threed_section_id',
        'threed_bet_slip_id',
        'slip_number',
        'bet_number',
        'bet_amount',
        'reward_amount',
        'rewrad_status'
    ];
}