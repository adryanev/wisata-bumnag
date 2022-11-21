<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExploreResource extends JsonResource
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
            'rating' => $this->rating,
            'title' => $this->title,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'reviewable' => new ReviewableResource($this->reviewable),
            'media' => $this->photos,
            'created_at' => $this->created_at,
        ];
    }
}
