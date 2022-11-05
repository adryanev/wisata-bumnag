<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SouvenirResource extends JsonResource
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
            'term_and_conditions' => null,
            'quantity' => 851,
            'description' => 'Iusto dolorem sequi a fuga sunt.',
            'destination_id' => 48,
            'media' => $this->photos,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
