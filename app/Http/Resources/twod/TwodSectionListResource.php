<?php

namespace App\Http\Resources\twod;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TwodSectionListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'type'         => $this->type?->name,
            'opening_time' => Carbon::parse($this->opening_datetime)->format('h:i A'),
            'ended_time'   => Carbon::parse($this->closing_datetime)->format('h:i A'),
            'time_part'    => Carbon::parse($this->opening_datetime)->format('A') === "AM" ? 'Morning Part' : 'Evening Part' ,
            'ended'        => (boolean)$this->ended,
            'date'         => Carbon::parse($this->opening_datetime)->format('d-m-Y'),
            'odd'          => $this->odd,
          	'winning_number' => (boolean)$this->ended ? (string)$this->winning_number : ""
        ];
    }
}
