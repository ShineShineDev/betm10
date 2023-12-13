<?php

namespace App\Http\Resources\thaid;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ThaidBetLogResource extends JsonResource
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
            // 'section_id' => $this->thaid_section_id,
            // 'threed_bet_slip_id' => $this->thaid_bet_slip_id,
            // 'slip_number' => $this->slip_number,
            'bet_number' => $this->bet_number,
            'reward_amount' => $this->reward_amount,
            'rewrad_status' => $this->rewrad_status
        ];
    }
}