<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'term_and_condition' => $this->term_and_condition,
            'instagram' => $this->instagram,
            'website' => $this->website,
            'capacity' => $this->capacity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'media' => $this->photos,
            'reviews' => new ReviewCollection($this->reviews),
            'tickets' => new TicketCollection($this->tickets()->orderBy('price', 'ASC')->get()),
            'recommendations' => EventResource::collection(Event::inRandomOrder()->take(5)->get()),
        ];
    }
}
