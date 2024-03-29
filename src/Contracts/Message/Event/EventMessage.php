<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface EventMessage extends Event
{
    /**
     * 事件类型
     * @return string|null
     */
    public function getEvent(): ?string;
}
