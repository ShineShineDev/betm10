<?php

namespace App\Models;

use App\Models\TwodType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwodSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'twod_type_id',
        'opening_time',
        'closing_time',
        'odd',
        'min_amount',
        'max_amount',
        'user_commission',
        'agent_commission',
        'block_numbers',
        'status'
    ];

    public function TwodType(){
        return $this->belongsTo(TwodType::class,'twod_type_id','id');
    }

    public function scopeActive($query){
        return $query->where('status' , 1);
    }


}
