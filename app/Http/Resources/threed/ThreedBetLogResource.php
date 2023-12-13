<?php

namespace App\Http\Resources\threed;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreedBetLogResource extends JsonResource
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
            'id' => $this->id,
            'section_id' => $this->threed_section_id,
            'threed_bet_slip_id' => $this->threed_bet_slip_id,
            'slip_number' => $this->slip_number,
            'bet_number' => $this->bet_number,
            'bet_amount' => $this->bet_amount,
            'reward_amount' => $this->reward_amount,
            'rewrad_status' => $this->rewrad_status
        ];
    }
}