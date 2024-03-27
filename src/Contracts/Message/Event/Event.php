<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/2/24
 * Time: 17:35
 */

namespace HughCube\Laravel\WeChat\Contracts\Message\Event;

use Carbon\Carbon;
use Illuminate\Cache\Repository;

interface Event
{
    /**
     * 开发者微信号
     */
    public function getToUserName(): ?string;

    /**
     * 发送方帐号（一个OpenID）
     */
    public function getFromUserName(): ?string;

    /**
     * 消息创建时间 （整型）
     */
    public function getCreatedAt(): ?Carbon;

    /**
     * 消息类型
     */
    public function getMessageType(): ?string;

    /**
     * 文本消息内容
     */
    public function getContent(bool $trim = true): ?string;

    public function contentIs($pattern, $trim = true): bool;

    public function contentEq($string, bool $trim = true): bool;

    public function contentContains($needles, $ignoreCase = false, $trim = true): bool;

    public function contentStartsWith($needles, $trim = true): bool;

    public function contentEndsWith($needles, $trim = true): bool;

    /**
     * 事件KEY值
     * @return string|int|null
     */
    public function getEventKey();

    public function eventKeyIs($pattern): bool;

    public function eventKeyEq($key): bool;

    public function eventKeyContains($needles, $ignoreCase = false, $trim = true): bool;

    public function eventKeyStartsWith($needles, $trim = true): bool;

    public function eventKeyEndsWith($needles, $trim = true): bool;

    public function getStore(): Repository;
}
