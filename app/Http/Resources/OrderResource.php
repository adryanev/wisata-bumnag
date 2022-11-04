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
        $order_detail = $this->orderDetail();
        return [
            "total_price" => $this->total_price,
            "orderDetails" => OrderDetailResource::collection($order_detail->get()),
        ];
    }
}
