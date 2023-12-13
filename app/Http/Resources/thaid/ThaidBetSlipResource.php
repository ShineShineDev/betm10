<?php

namespace App\Http\Resources\thaid;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class ThaidBetSlipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    //"bet_date" =>  Carbon::parse($this->bet_date)->format('F j Y g:ia'), 
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            // "customer_id" => $this->customer_id,
            "slip_number" => $this->slip_number,
            "total_amount" => $this->total_amount,
            "bet_date" => Carbon::parse($this->bet_date)->format('F j Y'),
            "is_reject" => $this->is_reject == 0 ? 'Active' : "Rejected",
            "section" => [
                'id' => $this->thaiDSection->id,
                'opening_date' => $this->thaiDSection->opening_date,
                'opening_time' => $this->thaiDSection->opening_time,
                'closing_time' => $this->thaiDSection->closing_time,
                'bet_amount' => $this->thaiDSection->to_bet_amount
            ],
            "betting_logs" => ThaidBetLogResource::collection($this->thaiDBettingLogs)
        ];
    }
}


