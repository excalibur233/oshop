<?php

namespace OShop\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Spu extends Resource
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
            'statistic_category_id' => $this->statistic_category_id,
            'name' => $this->name,
            'description' => $this->description,
            'shown_price' => $this->shown_price,
            'sold_count' => $spu->sold_count,            
            'image_thumbnail' => $this->image_thumbnail,
            'detail' => $this->detail,
            'image_slide' => $this->image_slide,
            'statistic_category' => new SpuStatisticCategory($this->statisticCategory)
        ];
    }
}
