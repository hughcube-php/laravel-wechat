<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserMessageLocation as Contract;

class UserMessageLocation extends Event implements Contract
{
    public function getLatitude(): ?float
    {
        return $this->getMessage('Location_X');
    }

    public function getLongitude(): ?float
    {
        return $this->getMessage('Location_Y');
    }

    public function getScale(): ?float
    {
        return $this->getMessage('Scale');
    }

    public function getLabel(): ?string
    {
        return $this->getMessage('Label');
    }
}
