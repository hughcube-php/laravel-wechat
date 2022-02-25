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
    public function getFormat(): ?string
    {
        return $this->getMessage('Format');
    }

    public function getMediaId(): ?string
    {
        return $this->getMessage('MediaId');
    }

    public function getRecognition(): ?string
    {
        return $this->getMessage('Recognition');
    }
}
