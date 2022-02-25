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
    public function getLatitude(): null|float
    {
        return $this->getMessage('Latitude');
    }

    public function getLongitude(): null|float
    {
        return $this->getMessage('Longitude');
    }

    public function getPrecision(): null|float
    {
        return $this->getMessage('Precision');
    }
}
