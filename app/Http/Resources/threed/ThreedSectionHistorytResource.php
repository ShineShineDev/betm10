<?php

namespace App\Http\Resources\threed;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreedSectionHistorytResource extends JsonResource
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
            "opening_date" => $this->opening_date->format('Y-m-d'),
            "winning_number" => $this->winning_number,
        ];
    }
}