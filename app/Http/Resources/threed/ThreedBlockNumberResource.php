<?php

namespace App\Http\Resources\threed;

use Illuminate\Http\Resources\Json\JsonResource;

class ThreedBlockNumberResource extends JsonResource
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
            'threed_section_id' => $this->threed_section_id,
            'number' => $this->number,
        ];
    }
}