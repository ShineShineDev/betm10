<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $aa=$this->resource;
        $aa['payment_name']=$this->payment_type->payment_type;
        return $aa;
    }
    public function with($request){
        return ['aa'=>"aa"];
    }
}
