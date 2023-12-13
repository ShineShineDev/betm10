<?php

namespace App\Http\Resources\twod;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TwodCalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $opening_datetime = Carbon::parse($this->opening_datetime);
        return [
            'id'               => $this->id,
            'opening_datetime' => $opening_datetime,
            'winning_number'   => $this->winning_number,
            'day'              => $opening_datetime->format('d'),
            'month'            => $opening_datetime->format('m'),
            'year'             => $opening_datetime->format('Y'),
        ];
    }
}
