<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'price_include' => $this->price_include,
            'price_exclude' => $this->price_exclude,
            'activities' => $this->activities,
            'destination' => $this->destination,
            'media' => $this->photos,
            'categories' => $this->categories,
            'reviews' => new ReviewAggregateCollection($this->reviews),
            'tickets' => new TicketCollection($this->tickets()->with(['ticketSetting'])->orderBy('price', 'ASC')->get()),
        ];
    }
}
