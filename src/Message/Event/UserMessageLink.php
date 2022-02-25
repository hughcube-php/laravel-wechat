<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageLink as Contract;

class UserMessageLink extends Event implements Contract
{
    public function getTitle(): null|string
    {
        return $this->getMessage('Title');
    }

    public function getDescription(): null|string
    {
        return $this->getMessage('Description');
    }

    public function getUrl(): null|string
    {
        return $this->getMessage('Url');
    }
}
