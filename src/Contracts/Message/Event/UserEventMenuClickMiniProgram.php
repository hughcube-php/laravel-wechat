<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserEventMenuClickMiniProgram extends UserEvent, UserEventMenu
{
    public function getPage(): string;

    public function getMenuId(): string;
}
