<?php

namespace OShop\Core\Shop\Commodity;

use Illuminate\Database\Eloquent\Model;

class SpuStatisticCategory extends Model
{
    public function spu()
    {
        return $this->hasMany(Spu::class);
    }
}
