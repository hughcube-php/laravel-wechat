<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageVoice as Contract;

class UserMessageVoice extends Event implements Contract
{
    public function getFormat(): null|string
    {
        return $this->getMessage('Format');
    }

    public function getMediaId(): null|string
    {
        return $this->getMessage('MediaId');
    }

    public function getRecognition(): null|string
    {
        return $this->getMessage('Recognition');
    }
}
