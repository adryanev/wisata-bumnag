<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'id' =>$this->id,
            'title'=> $this->title,
            'description'=> $this->reviewable,
            'reviewable_id'=>$this->reviewable_id,
            'reviewable_type'=>$this->reviewable_type,
            'user'=> $this->user,
            'created_at'=> $this->created_at,
            'updated_at'=>$this->updated_at

        ];
    }
}
