<?php

namespace App\Http\Resources;

use App\Models\Destination;
use App\Models\Package;
use App\Models\Souvenir;
use App\Models\Ticket;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderableDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource instanceof Ticket) {
            $ticketable = $this->ticketable;
            return [
                'id' => $ticketable->id,
                'type' => Destination::class,
                'name' => $ticketable->name,
                'media' => $ticketable->photos,
            ];
        }
        if ($this->resource instanceof Souvenir) {
            return [
                'id' => $this->id,
                'type' => Souvenir::class,
                'name' => $this->name,
                'media' => $this->photos,
            ];
        }
        if ($this->resource instanceof Package) {
            return [
                'id' => $this->id,
                'type' => Package::class,
                'name' => $this->name,
                'media' => $this->photos,
            ];
        }
    }
}
