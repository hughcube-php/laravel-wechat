<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface EventMessage
{
    /**
     * 事件类型
     * @return string|null
     */
    public function getEvent(): ?string;

    /**
     * 事件KEY值
     * @return string|null
     */
    public function getEventKey(): ?string;
}
