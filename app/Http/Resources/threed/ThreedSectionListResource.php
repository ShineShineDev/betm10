<?php

namespace App\Http\Resources\threed;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreedSectionListResource extends JsonResource
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
            "opening_time" => $this->opening_time,
            "closing_time" => $this->closing_time,
            "odd" => $this->odd,
            "r_odd" => $this->r_odd,
            "min_amount" => $this->min_amount,
            "max_amount" => $this->max_amount,
            "user_commission" => $this->user_commission,
            "agent_commission" => $this->agent_commission,
            "set" => $this->set,
            "value" => $this->value,
            "winning_number" => $this->winning_number,
            "reward_users" => $this->reward_users,
            "is_maintenace" => $this->is_maintenace,
            "status" => $this->status,
            'block_number' => ThreedBlockNumberResource::collection($this->threedBlockNumbers),
            'number_limit' => ThreedNumberLimitResource::collection($this->threedNumberLimits)
        ];
    }
}