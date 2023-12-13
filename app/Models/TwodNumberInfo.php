<?php

namespace App\Models;

use App\Models\TwodSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwodNumberInfo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'number','min_amount','max_amount','is_blocked','twod_section_id'
    ];
    
    public function section(){
        return $this->belongsTo(TwodSection::class,'twod_section_id','id');
    }
    
    public function getPercent($number){
        $maximum_amount = $this->getMaximumAmount($number);
        $total_amount = $this->getTotalAmount($number);
        if ($maximum_amount == 0 || $total_amount == 0) {
            return 0;
        } else {
            return ($total_amount / $maximum_amount) * 100;
        }
    }

    public function getMaximumAmount($number){
        return $this->$number->maximum_amount;
    }

    public function geMinimumAmount($number){
        return $this->$number->min_amouunt;
    }

}
