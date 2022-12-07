<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $orderable = $this->orderable;
        return [
            "id" => $this->id,
            "orderable_type" => $this->orderable_type,
            "orderable_id" => $this->orderable_id,
            "orderable_name" => $this->orderable_name,
            "orderable_price" => $this->orderable_price,
            "quantity" => $this->quantity,
            "subtotal" => $this->subtotal,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "order_id" => 11,
            "orderable_detail" => new OrderableDetailResource($this->orderable),

        ];
    }
}
