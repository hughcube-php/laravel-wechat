<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserMessageText extends UserMessage
{
    /**
     * 文本消息内容
     * @return string|null
     */
    public function getContent(): null|string;
}
