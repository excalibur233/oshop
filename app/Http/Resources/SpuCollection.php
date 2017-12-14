<?php

namespace OShop\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SpuCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($spu) {
                return [
                    'id' => $spu->id,
                    'statistic_category_id' => $spu->statistic_category_id,
                    'name' => $spu->name,
                    'description' => $spu->description,
                    'shown_price' => $spu->shown_price,
                    'shown_commission' => $spu->shown_commission,
                    'sold_count' => $spu->sold_count,
                    'image_thumbnail' => $spu->image_thumbnail,
                    'statistic_category' => new SpuStatisticCategory($spu->statisticCategory)
                ];
            })
        ];
    }
}
