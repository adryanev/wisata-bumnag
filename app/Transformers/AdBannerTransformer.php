<?php

namespace App\Transformers;

use App\Models\AdBanner;
use League\Fractal\TransformerAbstract;

class AdBannerTransformer extends TransformerAbstract
{

    public function transform(AdBanner $banner)
    {
        return [
            'name' => $banner->name,
            'images' => $banner->images,
            'target' => $banner->target,
        ];
    }
}
