<?php

namespace OShop\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Sku extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'spu_id' => $this->spu_id,
            'label' => $this->label,
            'description' => $this->description,
            'storage' => $this->storage
        ];
    }
}
