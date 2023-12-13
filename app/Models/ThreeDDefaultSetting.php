<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDDefaultSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'odd',
        'r_odd',
        'min_amount',
        'max_amount',
        'user_commission',
        'agent_commission',
        'closing_time',
        'block_numbers',
        'is_maintenace',
        'status',
    ];
}