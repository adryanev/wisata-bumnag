<?php

namespace App\Transformers;

use App\Models\Application;
use League\Fractal\TransformerAbstract;

class ApplicationTransformer extends TransformerAbstract
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
    public function transform(Application $application)
    {
        return [
            'name' => $application->name,
            'identifier' => $application->identifier,
            'signature' => $application->signature,
        ];
    }
}
