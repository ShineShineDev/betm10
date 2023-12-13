<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDBettingSlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'threed_section_id',
        'slip_number',
        'total_amount',
        'bet_date',
        'is_reject',
    ];
    public function threeDBettingLogs()
    {
        return $this->hasMany(ThreeDBettingLog::class, 'threed_bet_slip_id', 'id');
    }
    public function threeDSection()
    {
        return $this->belongsTo(ThreeDSection::class, 'threed_section_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}