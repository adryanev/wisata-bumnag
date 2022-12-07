<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{

    private $token;
    private $avatar;

    public function __construct($req, $token, $avatar)
    {
        parent::__construct($req);
        $this->token = $token;
        $this->avatar = $avatar;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            'data' => [
                'user' => [
                    'id' => $this->id,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone_number' => $this->phone_number,
                    'nik' => $this->nik,
                    'avatar' => $this->avatar,
                    "roles" => $this->roles()->pluck('name')->first(),

                ],
                'authorization' => [
                    'token' => $this->token,
                ],
            ],
        ];
    }
}
