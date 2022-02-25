<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Message\Event;

use HughCube\Laravel\WeChat\Contracts\Message\Event\TemplateMessageEventSendJobFinish as Contract;

class TemplateMessageEventSendJobFinish extends Event implements Contract
{
    /**
     * 发送状态为成功
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->getMessage('Status');
    }

    public function isSuccess(): bool
    {
        return $this->getStatus() === 'success';
    }
}
