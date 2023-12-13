<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDBlockNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        "threed_section_id",
        "number"
    ];
}