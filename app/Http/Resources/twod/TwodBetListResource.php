<?php

namespace App\Http\Resources\twod;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TwodBetListResource extends JsonResource
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
            'id'             => $this->id,
            'bet_date'       => Carbon::parse($this->bet_date)->format('d-m-Y h:i A'),
            'total_bet_logs' => count($this->bet_logs),
            'section'        => $this->section ? new TwodSectionListResource($this->section) : null,
            'total_amount'   => $this->total_amount,
            'created_at'     => now(),
            'slip_number'    => $this->slip_number,
        ];
    }
}
