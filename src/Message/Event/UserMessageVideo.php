<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageVideo as Contract;

class UserMessageVideo extends Event implements Contract
{
    public function getThumbMediaId(): ?string
    {
        return $this->getMessage('ThumbMediaId');
    }

    public function getMediaId(): ?string
    {
        return $this->getMessage('MediaId');
    }
}
