<?php

namespace App\Http\Resources\thaid;

use Illuminate\Http\Resources\Json\JsonResource;

class LatestThaidSectionResource extends JsonResource
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
            'ticket_amount' => $this->to_bet_amount,
            "opening_date" => date("D, d M y", strtotime($this->opening_date)),
            "day" => date("d", strtotime($this->opening_date)),
            "hours" => date("H", strtotime($this->opening_time)),
            "minute" => date("i", strtotime($this->opening_time)),
            "second" => date("s", strtotime($this->opening_time)),
            // "opening_time" => $this->opening_time,
            // "closing_time" => $this->closing_time,
            // "user_commission" => $this->user_commission,
            // "agent_commission" => $this->agent_commission
        ];
    }
}