<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\TwodType;
use App\Models\TwodBetSlip;
use App\Models\TwodNumberInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwodSection extends Model
{
    use HasFactory;

    protected $appends = ['ended'];

    protected $fillable = [
        'opening_datetime',
        'closing_datetime',
        'odd',
        'min_amount',
        'max_amount',
        'user_commission',
        'agent_commission',
        'set',
        'value',
        'winning_number',
        'reward_users',
        'status',
        'twod_type_id'
    ];

    public function numbers(){
        return $this->hasMany(TwodNumberInfo::class,'twod_section_id','id');
    }

    public function bet_slips(){
        return $this->hasMany(TwodBetSlip::class,'twod_section_id','id');
    }

    public function getEndedAttribute(){
        return Carbon::now()->gt(Carbon::parse($this->opening_datetime));
    }

    public function type(){
        return $this->belongsTo(TwodType::class,'twod_type_id','id');
    }

    public function getTotalAmount($number){

        $slips = $this->bet_slips()->get();

        $tot_bet_amount =  0;

        if(!count($slips)) return $tot_bet_amount;

        foreach($slips as $item){
            $tot_bet_amount +=  $item->bet_logs()->where('bet_number',$number)->sum('bet_amount');
        }

        return $tot_bet_amount;
    }

    public function getPercent($number)
    {
        if(count($this->numbers)){
            $maximum_amount = $this->numbers()->where('number',$number)->first()->max_amount;
        }else{
            $maximum_amount = $this->max_amount;
        }

        $total_amount = $this->getTotalAmount($number);

        if ($maximum_amount == 0 || $total_amount == 0) {
            return 0;
        } else {
            return ($total_amount / $maximum_amount) * 100;
        }
    }
}
