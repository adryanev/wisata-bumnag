<?php

namespace App\Http\Resources;

use App\Models\Package;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageDetailResource extends JsonResource
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
            'reviews' => new ReviewCollection($this->reviews),
            'tickets' => new TicketCollection($this->tickets()->orderBy('price', 'ASC')->get()),
            'amenities' => new PackageAmenityCollection($this->amenities),
            'recommendations' => PackageResource::collection(Package::whereHas('tickets')->inRandomOrder()->take(5)->get()),

        ];
    }
}
