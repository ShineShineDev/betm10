<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\TwodBetLog;
use App\Models\TwodSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwodBetSlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id','twod_section_id','slip_number','total_amount','bet_date','is_reject'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function section(){
        return $this->belongsTo(TwodSection::class,'twod_section_id','id');
    }

    public function bet_logs(){
        return $this->hasMany(TwodBetLog::class,'twod_bet_slip_id','id');
    }

    public function scopeWhereAuth($query)
    {
        return $query->where('customer_id',auth()->user()->id);
    }
    

}
