<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThaiDSection extends Model
{
    use HasFactory;
    protected $fillable = [
        "opening_date",
        "opening_time",
        "closing_time",
        "to_bet_amount",
        "user_commission",
        "agent_commission",
        "is_maintenace",
        "status",
    ];

    public function bettingLogs()
    {
        // return $this->hasMany(ThreeDBettingLog::class, 'threed_section_id', 'id');
    }
    

}









