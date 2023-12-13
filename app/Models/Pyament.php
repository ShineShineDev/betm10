<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Image;

class Pyament extends Model
{
    use HasFactory;
    protected $fillable = ['status','payment_phone','payment_name','payment_type', 'avatar','rate'];
    
    //  protected $casts    = [
    //     'avatar' => Image::class,
    // ];
}
