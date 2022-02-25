<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageText as Contract;

class UserMessageText extends Event implements Contract
{
    public function getContent(): ?string
    {
        return $this->getMessage('Content');
    }
}
