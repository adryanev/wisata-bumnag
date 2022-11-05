<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $order_detail = $this->orderDetails();
        return [
            'number' => $this->number,
            'note' => $this->note,
            'status' => $this->status,
            'order_date' => $this->order_date,
            "total_price" => $this->total_price,
            "order_details" => OrderDetailResource::collection($order_detail->get()),
        ];
    }
}
