<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface LinkMessage
{
    /**
     * 地理位置纬度
     *
     * @return string|null
     */
    public function getUrl(): ?string;
}
