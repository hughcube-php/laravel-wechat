<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventMenuClickMiniProgram as Contract;

class UserEventMenuClickMiniProgram extends Event implements Contract
{
    public function getPage(): string
    {
        return $this->getEventKey();
    }

    public function getMenuId(): string
    {
        return $this->getMessage('MenuId');
    }
}
