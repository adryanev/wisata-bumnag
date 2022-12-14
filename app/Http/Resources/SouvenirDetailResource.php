<?php

namespace App\Http\Resources;

use App\Models\Souvenir;
use Illuminate\Http\Resources\Json\JsonResource;

class SouvenirDetailResource extends JsonResource
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
            'quantity' => $this->quantity,
            'description' => $this->description,
            'destination_id' => $this->destination_id,
            'media' => $this->photos,
            'reviews' => new ReviewCollection($this->reviews),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'categories' => $this->categories,
            'recommendations' => SouvenirResource::collection(
                Souvenir::where([['destination_id', '=', $this->destination_id], ['id', '<>', $this->id]])->get()
            ),
        ];
    }
}
