<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventSubscribe as Contract;

class UserEventSubscribe extends Event implements Contract
{
    public function isScan(): bool
    {
        return false;
    }
}
