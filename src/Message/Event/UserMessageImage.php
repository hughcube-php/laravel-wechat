<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageImage as Contract;

class UserMessageImage extends Event implements Contract
{
    public function getPicUrl(): ?string
    {
        return $this->getMessage('PicUrl');
    }

    public function getMediaId(): ?string
    {
        return $this->getMessage('MediaId');
    }
}
