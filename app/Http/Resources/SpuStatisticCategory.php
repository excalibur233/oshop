<?php

namespace OShop\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SpuStatisticCategory extends Resource
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
            'name' => $this->name,
            'label' => $this->label,
        ];
    }
}
