<?php

namespace App\Http\Resources\BackOffice\Animation;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AnimationCollection extends ResourceCollection
{
    public $collects = AnimationResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
