<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserEventLocation extends UserEvent, LocationMessage
{
    /**
     * 地理位置精度
     * @return float|null
     */
    public function getPrecision(): ?float;
}
