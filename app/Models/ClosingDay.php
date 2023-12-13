<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingDay extends Model
{
    use HasFactory;
  
  	protected $table = "closing_days";

    protected $fillable = [
      'title','date','description'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
