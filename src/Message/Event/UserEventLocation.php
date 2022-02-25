<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\UserEventLocation as Contract;

class UserEventLocation extends Event implements Contract
{
    public function getLatitude(): ?float
    {
        return $this->getMessage('Latitude');
    }

    public function getLongitude(): ?float
    {
        return $this->getMessage('Longitude');
    }

    public function getPrecision(): ?float
    {
        return $this->getMessage('Precision');
    }
}
