<?php

namespace App\Transformers;

use App\Models\Destination;
use League\Fractal\TransformerAbstract;

class DestinationTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Destination $model)
    {
        return [
            'name' => $model->name,
            'description' => $model->description,
            'address' => $model->address,
            'phone_number' => $model->phone_number,
            'email' => $model->email,
            'latitude' => $model->latitude,
            'longitude' => $model->longitude,
            'opening_hours' => $model->opening_hours,
            'closing_hours' => $model->closing_hours,
            'instagram' => $model->instagram,
            'website' => $model->website,
            'capacity' => $model->capasity
        ];
    }
}
