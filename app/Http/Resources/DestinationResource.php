<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'opening_hours' => $this->opening_hours,
            'closing_hours' => $this->closing_hours,
            'working_day' => $this->working_day,
            'instagram' => $this->instagram,
            'website' => $this->website,
            'capacity' => $this->capacity,
            'categories' => $this->categories,
            'media' => $this->photos,
            'reviews' => new ReviewAggregateCollection($this->reviews),
            'tickets' => new TicketCollection($this->tickets()->orderBy('price', 'ASC')->get()),

        ];
    }
}
