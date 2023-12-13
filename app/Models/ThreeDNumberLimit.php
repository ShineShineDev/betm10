<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDNumberLimit extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'min_amount',
        'max_amount',
        'threed_section_id',
    ];
}