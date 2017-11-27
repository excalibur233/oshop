<?php


namespace OShop\Core\User;


/**
 * Trait HasIntroducer
 * @package OShop\Core\User
 * @mixin User
 */
trait HasIntroducer
{
    public function hasIntroducer()
    {
        return !!$this->introducer_id;
    }

    public function introducer()
    {
        return $this->belongsTo(User::class, 'introducer_id');
    }
}