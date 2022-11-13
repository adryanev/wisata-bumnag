<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'is_free' => $this->is_free,
            'term_and_conditions' => $this->term_and_conditions,
            'is_quantity_limited' => $this->is_quantity_limited,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'ticketable_type' => $this->ticketable_type,
            'ticketable_id' => $this->ticketable_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'settings' => new TicketSettingResource($this->ticketSetting),
        ];
    }
}
