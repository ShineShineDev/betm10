<?php

namespace App\Models;

use App\Models\TwodBetSlip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwodBetLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'towd_bet_slip_id','slip_number','reward_amount', 'reward_status','draw_date','bet_number','bet_amount','is_reject'
    ];

    public function twod_bet_slip(){
        return $this->belongsTo(TwodBetSlip::class,'twod_bet_slip_id','id');
    }

    public function scopeIsNotReject($query){
        return $query->where('is_reject' ,'!=', 1);
    }

}
