<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickView as Contract;
use HughCube\PUrl\HUrl;

class UserEventMenuClickView extends Event implements Contract
{
    public function getUrl(): ?HUrl
    {
        return HUrl::parse($this->getEventKey());
    }
}
