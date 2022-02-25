<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

use Carbon\Carbon;

interface Event
{
    /**
     * 开发者微信号
     * @return string|null
     */
    public function getToUserName(): ?string;

    /**
     * 发送方帐号（一个OpenID）
     * @return string|null
     */
    public function getFromUserName(): ?string;

    /**
     * 消息创建时间 （整型）
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon;

    /**
     * 消息类型
     * @return string|null
     */
    public function getMessageType(): ?string;
}
