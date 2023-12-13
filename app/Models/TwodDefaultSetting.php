<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwodDefaultSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'opening_time',
        'closing_time',
        'odd',
        'min_amount',
        'max_amount',
        'user_commission',
        'agent_commission',
        'block_numbers'
    ];

}
