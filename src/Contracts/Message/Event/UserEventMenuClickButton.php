<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserEventMenuClickButton extends UserEvent
{
    /**
     * 事件KEY值，与自定义菜单接口中KEY值对应
     * @return string|null
     */
    public function getButtonKey(): null|string;
}
