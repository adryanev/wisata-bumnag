<?php

namespace App\Http\Resources;

use App\Models\Destination;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationDetailResource extends JsonResource
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
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'opening_hours' => $this->opening_hours,
            'closing_hours' => $this->closing_hours,
            'instagram' => $this->instagram,
            'website' => $this->website,
            'capacity' => $this->capacity,
            'categories' => $this->categories,
            'media' => $this->photos,
            'reviews' => new ReviewCollection($this->reviews),
            'tickets' => new TicketCollection($this->tickets()->orderBy('price', 'ASC')->get()),
            'recommendations' => DestinationResource::collection(Destination::inRandomOrder()->take(5)->get()),
        ];
    }
}
