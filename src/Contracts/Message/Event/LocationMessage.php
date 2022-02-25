<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface LocationMessage
{
    /**
     * 地理位置纬度
     *
     * @return float|null
     */
    public function getLatitude(): null|float;

    /**
     * 地理位置经度
     *
     * @return float|null
     */
    public function getLongitude(): null|float;
}
