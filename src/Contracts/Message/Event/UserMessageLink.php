<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface UserMessageLink extends UserMessage, LinkMessage
{
    /**
     * 消息标题
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * 消息描述
     *
     * @return string|null
     */
    public function getDescription(): ?string;
}
