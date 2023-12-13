<?php

namespace App\Http\Resources\threed;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class ThreedBetSlipResource extends JsonResource
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
            "customer_id" => $this->customer_id,
            "slip_number" => $this->slip_number,
            "total_amount" => $this->total_amount,
            "bet_date" =>  Carbon::parse($this->bet_date)->format('F j Y'), 
            "is_reject" => $this->is_reject == 0 ? 'Active' : "Rejected",
            "section" => [
                'id' => $this->threeDSection->id,
                'opening_date' => $this->threeDSection->opening_date->format('Y-m-d'),
                'opening_time' => $this->threeDSection->opening_time,
                'closing_time' => $this->threeDSection->closing_time,
                'odd' => $this->threeDSection->odd,
                'r_odd' => $this->threeDSection->r_odd,
            ],
            "betting_logs" => ThreedBetLogResource::collection($this->threeDBettingLogs)
        ];
    }
}


