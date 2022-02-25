<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserMessageLocation extends UserMessage, LocationMessage
{
    /**
     * 地图缩放大小
     * @return float|null
     */
    public function getScale(): ?float;

    /**
     * 地理位置信息
     * @return string|null
     */
    public function getLabel(): ?string;
}
