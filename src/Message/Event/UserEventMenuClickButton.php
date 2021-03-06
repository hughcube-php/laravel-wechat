<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickButton as Contract;

class UserEventMenuClickButton extends Event implements Contract
{
    public function getButtonKey(): ?string
    {
        return $this->getEventKey();
    }

    public function isKey(...$keys): bool
    {
        foreach ($keys as $key) {
            if ($key == $this->getButtonKey()) {
                return true;
            }
        }
        return false;
    }
}
