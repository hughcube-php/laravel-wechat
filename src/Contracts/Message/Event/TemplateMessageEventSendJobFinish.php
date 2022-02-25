<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

interface TemplateMessageEventSendJobFinish extends Event, UserEvent, TemplateMessageEvent, MessageIdMessage
{
    /**
     * 发送状态
     * @return string|null
     */
    public function getStatus(): ?string;

    /**
     * 是否发送成功
     * @return bool
     */
    public function isSuccess(): bool;
}
