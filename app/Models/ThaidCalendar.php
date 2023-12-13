<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThaidCalendar extends Model
{
    use HasFactory;
    protected $fillable = ['thaidprice_id', 'winning_number', 'thaidsection_id'];

    public function thaidsection(){
        return $this->belongsTo(Thaidsection::class);
    }

    public function thaidprice()
    {
        return  $this->belongsTo(Thaidprice::class);
    }
}
