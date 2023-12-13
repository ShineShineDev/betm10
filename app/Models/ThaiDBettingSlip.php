<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThaiDBettingSlip extends Model
{
    use HasFactory;
    protected $fillable = [
        "slip_number",
        "customer_id",
        "total_amount",
        "thaid_section_id",
        "bet_date",
        "is_reject",
    ];
    public function thaiDBettingLogs()
    {
        return $this->hasMany(ThaiDBettingLog::class, 'thaid_bet_slip_id', 'id');
    }
    public function thaiDSection()
    {
        return $this->belongsTo(ThaiDSection::class, 'thaid_section_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}














