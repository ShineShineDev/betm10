<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'opening_date',
        'opening_time',
        'closing_time',
        'odd',
        'r_odd',
        'min_amount',
        'max_amount',
        'user_commission',
        'agent_commission',
        'is_maintenace',
        'set',
        'value',
        'winning_number',
        'reward_users',
        'status'
    ];
   protected $casts = [
        'opening_date' => 'date',
    ];

    public function threedBlockNumbers()
    {
        return $this->hasMany(ThreeDBlockNumber::class, 'threed_section_id', 'id');
    }
    public function threedNumberLimits()
    {
        return $this->hasMany(ThreeDNumberLimit::class, 'threed_section_id', 'id');
    }
    public function threedBettingLogs()
    {
        return $this->hasMany(ThreeDBettingLog::class, 'threed_section_id', 'id');
    }
}