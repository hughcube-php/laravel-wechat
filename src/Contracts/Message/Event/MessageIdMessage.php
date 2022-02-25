<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/25
 * Time: 00:16
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface MessageIdMessage
{
    /**
     * 消息id，64位整型
     * @return int|null
     */
    public function getMessageId(): ?int;
}
